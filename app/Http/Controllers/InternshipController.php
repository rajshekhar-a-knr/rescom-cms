<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\JobListing;
use App\Models\Testimonial;
use App\Services\SchoolStorageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'current');
        if (!in_array($type, ['current', 'alumni'])) {
            $type = 'current';
        }

        $currentInterns = Intern::with('department')
            ->where('intern_type', 'current')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $alumniInterns = Intern::with('department')
            ->where('intern_type', 'alumni')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $testimonialInterns = $currentInterns->concat($alumniInterns)
            ->sortBy('name')
            ->values();

        $counts = [
            'current' => $currentInterns->count(),
            'alumni' => $alumniInterns->count(),
        ];

        $internTestimonials = Testimonial::with('intern')
            ->where('is_active', 1)
            ->where('testimonial_source', 'student-college')
            ->whereNotNull('intern_id')
            ->whereHas('intern', function ($query) {
                $query->where('is_active', 1);
            })
            ->orderBy('sort_order')
            ->get();

        $internshipJobs = JobListing::where('status', 'open')
            ->where(function ($query) {
                $query->where('title', 'like', '%intern%')
                    ->orWhere('department', 'like', '%intern%')
                    ->orWhere('job_type', 'like', '%intern%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.internship', compact('currentInterns', 'alumniInterns', 'testimonialInterns', 'type', 'counts', 'internTestimonials', 'internshipJobs'));
    }

    public function show(Intern $intern)
    {
        if (!$intern->is_active) {
            abort(404);
        }

        $intern->load([
            'department',
            'testimonials' => function ($query) {
                $query->where('is_active', 1)
                    ->where('testimonial_source', 'student-college')
                    ->orderBy('sort_order');
            },
        ]);

        return view('pages.intern-detail', compact('intern'));
    }

    public function storeTestimonial(Request $request)
    {
        if (!verify_recaptcha_response($request)) {
            return back()
                ->withInput()
                ->withErrors(['testimonial_captcha' => 'Please complete the reCAPTCHA verification.']);
        }

        $data = $request->validate([
            'testimonial_intern_id' => [
                'required',
                'integer',
                Rule::exists('interns', 'id')->where('is_active', 1),
            ],
            'testimonial_rating' => ['required', 'integer', 'min:1', 'max:5'],
            'testimonial_content' => ['required', 'string', 'min:20', 'max:4000'],
        ]);

        $intern = Intern::where('is_active', 1)->findOrFail($data['testimonial_intern_id']);

        Testimonial::create([
            'intern_id' => $intern->id,
            'testimonial_source' => 'student-college',
            'client_name' => $intern->name,
            'client_designation' => $intern->designation,
            'client_company' => $intern->college_name,
            'client_photo' => $intern->photo,
            'content' => $data['testimonial_content'],
            'rating' => $data['testimonial_rating'],
            'project_type' => 'Internship Program',
            'is_featured' => false,
            'is_active' => false,
            'sort_order' => 0,
        ]);

        return back()->with('testimonial_success', 'Thank you! Your testimonial has been submitted and will appear after admin approval.');
    }

    public function verifyCertificateEmail(Request $request, Intern $intern, string $token)
    {
        if ($intern->intern_type !== 'alumni' || !$intern->certificate || $intern->certificate_token !== $token) {
            abort(404);
        }

        $data = $request->validate([
            'certificate_email' => ['required', 'email', 'max:255'],
        ]);

        if (!verify_recaptcha_response($request)) {
            return back()
                ->withInput()
                ->withErrors([
                    'certificate_captcha' => 'Please complete the reCAPTCHA verification.',
                ]);
        }

        $enteredEmail = trim(mb_strtolower($data['certificate_email']));
        $registeredEmail = trim(mb_strtolower((string) $intern->email));

        if ($registeredEmail === '' || $enteredEmail !== $registeredEmail) {
            return back()
                ->withInput()
                ->withErrors([
                    'certificate_email' => 'Email mismatch. Enter the correct email that is registered with Rescom.',
                ]);
        }

        session()->put($this->certificateAccessSessionKey($intern, $token), true);

        return redirect()->route('internship.certificate.download', [
            'intern' => $intern,
            'token' => $token,
        ]);
    }

    public function downloadCertificate(Intern $intern, string $token, SchoolStorageService $storageService)
    {
        if ($intern->intern_type !== 'alumni' || !$intern->certificate || $intern->certificate_token !== $token) {
            abort(404);
        }

        if (!session()->pull($this->certificateAccessSessionKey($intern, $token), false)) {
            return redirect()
                ->route('internship.show', $intern)
                ->withErrors([
                    'certificate_email' => 'Please verify your email first to download the certificate.',
                ]);
        }

        $path = parse_url($intern->certificate, PHP_URL_PATH);
        if (!$path) {
            abort(404);
        }

        $key = ltrim($path, '/');
        $presignedUrl = $storageService->getPresignedUrlByKey($key, 5, true, basename($key));

        if (!$presignedUrl) {
            abort(404);
        }

        return redirect($presignedUrl);
    }

    private function certificateAccessSessionKey(Intern $intern, string $token): string
    {
        return 'intern_certificate_access_' . $intern->id . '_' . $token;
    }
}
