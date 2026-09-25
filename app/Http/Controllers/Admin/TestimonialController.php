<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Services\SchoolStorageService;

class TestimonialController extends Controller {
    protected $storageService;

    public function __construct(SchoolStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index() {
        $testimonials = Testimonial::with('intern')->orderBy('sort_order')->paginate(20);
        return view('admin.pages.testimonials.index', compact('testimonials'));
    }
    public function create() { return view('admin.pages.testimonials.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'content' => 'required|string',
            'project_type' => 'nullable|string|max:255',
            'client_photo' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('client_photo')) {
            $companyCode = env('COMPANY_CODE', 'SITE');
            $academicYear = date('Y');
            $file = $request->file('client_photo');
            $originalName = $file->getClientOriginalName();
            $safeFileName = $this->storageService->generateSafeFilename($originalName, $companyCode);

            $uploadResult = $this->storageService->uploadFile(
                $companyCode,
                $academicYear,
                'testimonials',
                $file->getRealPath(),
                $safeFileName,
                'public-read'
            );

            if (!$uploadResult['success']) {
                return back()->withErrors(['client_photo' => $uploadResult['message'] ?? 'Photo upload failed.']);
            }

            $data['client_photo'] = $uploadResult['url'];
        }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success','Testimonial added!');
    }
    public function edit(Testimonial $testimonial) { return view('admin.pages.testimonials.form', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'content' => 'required|string',
            'project_type' => 'nullable|string|max:255',
            'client_photo' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('client_photo')) {
            $companyCode = env('COMPANY_CODE', 'SITE');
            $academicYear = date('Y');
            $file = $request->file('client_photo');
            $originalName = $file->getClientOriginalName();
            $safeFileName = $this->storageService->generateSafeFilename($originalName, $companyCode);

            $uploadResult = $this->storageService->uploadFile(
                $companyCode,
                $academicYear,
                'testimonials',
                $file->getRealPath(),
                $safeFileName,
                'public-read'
            );

            if (!$uploadResult['success']) {
                return back()->withErrors(['client_photo' => $uploadResult['message'] ?? 'Photo upload failed.']);
            }

            $data['client_photo'] = $uploadResult['url'];
        }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success','Testimonial updated!');
    }
    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success','Deleted!');
    }
    public function toggle($id) {
        $t = Testimonial::findOrFail($id);
        $t->update(['is_active'=>!$t->is_active]);
        return response()->json(['success'=>true]);
    }
}
