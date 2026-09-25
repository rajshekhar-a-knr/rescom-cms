<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Intern;
use App\Models\TeamDepartment;
use App\Models\Testimonial;

class InternController extends Controller
{
    public function index()
    {
        $interns = Intern::with('department')->orderBy('sort_order')->paginate(20);
        return view('admin.pages.interns.index', compact('interns'));
    }

    public function create()
    {
        $departments = TeamDepartment::orderBy('sort_order')->get();
        return view('admin.pages.interns.form', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'college_name' => 'nullable|string|max:255',
            'college_guide' => 'nullable|string|max:255',
            'knr_guide' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:team_departments,id',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string|max:2000',
            'intern_type' => 'required|in:current,alumni',
            'sort_order' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:5120',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'testimonial_id' => 'nullable|integer',
            'testimonial_rating' => 'nullable|integer|min:1|max:5',
            'testimonial_content' => 'nullable|string|max:4000',
            'testimonial_project_type' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = upload_to_storage($request->file('photo'), 'interns');
        }

        if ($request->hasFile('certificate')) {
            $data['certificate'] = upload_to_storage($request->file('certificate'), 'certificates');
            $data['certificate_token'] = Str::random(40);
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $intern = Intern::create($data);
        $this->syncStudentTestimonial($intern, $request);

        return redirect()->route('admin.interns.index')->with('success', 'Intern added!');
    }

    public function edit(Intern $intern)
    {
        $departments = TeamDepartment::orderBy('sort_order')->get();
        $testimonialDraft = $intern->testimonials()
            ->where('testimonial_source', 'student-college')
            ->latest('id')
            ->first();

        return view('admin.pages.interns.form', [
            'member' => $intern,
            'departments' => $departments,
            'testimonialDraft' => $testimonialDraft,
        ]);
    }

    public function update(Request $request, Intern $intern)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'college_name' => 'nullable|string|max:255',
            'college_guide' => 'nullable|string|max:255',
            'knr_guide' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:team_departments,id',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string|max:2000',
            'intern_type' => 'required|in:current,alumni',
            'sort_order' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:5120',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'testimonial_id' => 'nullable|integer',
            'testimonial_rating' => 'nullable|integer|min:1|max:5',
            'testimonial_content' => 'nullable|string|max:4000',
            'testimonial_project_type' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = upload_to_storage($request->file('photo'), 'interns');
        }

        if ($request->hasFile('certificate')) {
            $data['certificate'] = upload_to_storage($request->file('certificate'), 'certificates');
            $data['certificate_token'] = $intern->certificate_token ?: Str::random(40);
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $intern->update($data);
        $this->syncStudentTestimonial($intern, $request);

        return redirect()->route('admin.interns.index')->with('success', 'Intern updated!');
    }

    public function destroy(Intern $intern)
    {
        $intern->delete();
        return redirect()->route('admin.interns.index')->with('success', 'Intern deleted!');
    }

    public function toggle($id)
    {
        $intern = Intern::findOrFail($id);
        $intern->update(['is_active' => !$intern->is_active]);
        return response()->json(['success' => true]);
    }

    private function syncStudentTestimonial(Intern $intern, Request $request): void
    {
        $testimonialContent = trim((string) $request->input('testimonial_content'));
        $testimonialProjectType = trim((string) $request->input('testimonial_project_type'));

        $hasTestimonialData = $testimonialContent !== ''
            || $testimonialProjectType !== '';

        if (!$hasTestimonialData) {
            return;
        }

        $testimonial = null;
        $testimonialId = $request->input('testimonial_id');

        if ($testimonialId) {
            $testimonial = Testimonial::where('intern_id', $intern->id)
                ->where('testimonial_source', 'student-college')
                ->find($testimonialId);
        }

        if (!$testimonial) {
            $testimonial = Testimonial::where('intern_id', $intern->id)
                ->where('testimonial_source', 'student-college')
                ->latest('id')
                ->first();
        }

        $data = [
            'intern_id' => $intern->id,
            'testimonial_source' => 'student-college',
            'client_name' => $intern->name,
            'client_designation' => $intern->designation,
            'client_company' => $intern->college_name,
            'client_photo' => $intern->photo,
            'rating' => (int) $request->input('testimonial_rating', 5),
            'content' => $testimonialContent,
            'project_type' => $testimonialProjectType,
        ];

        if ($testimonial) {
            $data['is_active'] = $testimonial->is_active;
            $data['is_featured'] = $testimonial->is_featured;
            $data['sort_order'] = $testimonial->sort_order;
            $testimonial->update($data);
            return;
        }

        $data['is_active'] = false;
        $data['is_featured'] = false;
        $data['sort_order'] = 0;
        Testimonial::create($data);
    }
}
