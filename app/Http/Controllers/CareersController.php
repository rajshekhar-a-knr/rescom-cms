<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\CareerBenefit;
use App\Services\EmailService;
use Illuminate\Support\Facades\Log;

class CareersController extends Controller {
    protected EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function index(Request $request) {
        $departments = JobListing::where('status','open')
            ->whereNotNull('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        $departmentCounts = JobListing::where('status','open')
            ->selectRaw('department, COUNT(*) as total')
            ->groupBy('department')
            ->pluck('total','department');

        $jobs = JobListing::where('status','open')
            ->orderBy('created_at','desc')
            ->get();
        $grouped = $jobs->groupBy('department');
        $activeDepartment = $request->query('department');

        $benefits = CareerBenefit::where('is_active', 1)->orderBy('sort_order')->get();
        return view('pages.careers', compact('jobs','grouped','departments','departmentCounts','benefits','activeDepartment'));
    }
    public function show($slug) {
        $job = JobListing::where('slug',$slug)->where('status','open')->firstOrFail();
        $related = JobListing::where('id','!=',$job->id)->where('status','open')->take(3)->get();
        return view('pages.career-detail', compact('job','related'));
    }
    public function apply(Request $request, $id) {
        $job = JobListing::findOrFail($id);
        if (!verify_recaptcha_response($request)) {
            return back()
                ->withInput()
                ->withErrors(['career_captcha' => 'Please complete the reCAPTCHA verification.']);
        }

        $data = $request->validate([
            'applicant_name' => ['required','string','max:255','regex:/^[a-zA-Z\\s\\.' . "'" . '\\-]+$/'],
            'applicant_email' => 'required|email|max:255',
            'applicant_country_code' => 'nullable|in:+91,+1,+44,+61,+971',
            'applicant_phone' => ['nullable','string','max:20','regex:/^[0-9\\s\\+\\-\\(\\)]+$/'],
            'cover_letter' => 'nullable|string|max:3000',
            'portfolio_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'current_ctc' => 'nullable|string|max:100',
            'expected_ctc' => 'nullable|string|max:100',
            'notice_period' => 'nullable|string|max:100',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);
        $countryDigits = [
            '+91' => 10,
            '+1' => 10,
            '+44' => 10,
            '+61' => 9,
            '+971' => 9,
        ];
        if ($request->filled('applicant_phone')) {
            if (!$request->filled('applicant_country_code')) {
                return back()->withErrors(['applicant_country_code' => 'Please select a country code.'])->withInput();
            }
            $digits = preg_replace('/\\D+/', '', $request->applicant_phone);
            $expected = $countryDigits[$request->applicant_country_code] ?? null;
            if ($expected && strlen($digits) !== $expected) {
                return back()->withErrors(['applicant_phone' => "Phone number must be {$expected} digits for {$request->applicant_country_code}."])->withInput();
            }
        }
        $data['job_id'] = $job->id;
        if ($request->hasFile('resume')) {
            $data['resume_path'] = upload_to_storage($request->file('resume'), 'resumes');
        }
        unset($data['resume']);
        $application = JobApplication::create($data);

        if ($application) {
            $siteName = setting('site_name', 'Rescom');
            $siteLogo = setting('site_logo');
            $subject = "Application Received - {$job->title} | {$siteName}";

            $rows = [
                ['Position', $job->title],
                ['Applicant Name', $application->applicant_name],
                ['Email', $application->applicant_email],
                ['Phone', trim(($application->applicant_country_code ?? '') . ' ' . ($application->applicant_phone ?? ''))],
                ['Portfolio URL', $application->portfolio_url],
                ['LinkedIn URL', $application->linkedin_url],
                ['Current CTC', $application->current_ctc],
                ['Expected CTC', $application->expected_ctc],
                ['Notice Period', $application->notice_period],
                ['Cover Letter', $application->cover_letter],
            ];

            $html = view('emails.career-application-thankyou', [
                'rows' => $rows,
                'siteName' => $siteName,
                'siteLogo' => $siteLogo,
                'jobTitle' => $job->title,
            ])->render();

            $sent = $this->emailService->sendRawHtml($application->applicant_email, $subject, $html);
            Log::info('Career application email ' . ($sent ? 'sent' : 'failed') . ' to ' . $application->applicant_email, [
                'job_id' => $job->id,
                'application_id' => $application->id,
            ]);
        }
        return back()->with('success','Your application has been submitted! We will review it and get back to you soon.');
    }
}
