<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller {
    public function index() {
        $services = Service::with('category')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->paginate(20);
        return view('admin.pages.services.index', compact('services'));
    }
    public function create() {
        $categories = ServiceCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.pages.services.form', compact('categories'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'technologies' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'featured_image' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['sort_order'] = (int) ($request->input('sort_order', 0));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'services');
        }
        if ($request->features) $data['features'] = array_filter(explode("\n", $request->features));
        if ($request->technologies) $data['technologies'] = array_filter(explode("\n", $request->technologies));
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success','Service created!');
    }
    public function edit(Service $service) {
        $categories = ServiceCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.pages.services.form', compact('service','categories'));
    }
    public function update(Request $request, Service $service) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'technologies' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'featured_image' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['sort_order'] = (int) ($request->input('sort_order', 0));
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'services');
        }
        if ($request->features) $data['features'] = array_filter(explode("\n", $request->features));
        if ($request->technologies) $data['technologies'] = array_filter(explode("\n", $request->technologies));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success','Service updated!');
    }
    public function destroy(Service $service) {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success','Service deleted!');
    }
    public function toggle($id) {
        $s = Service::findOrFail($id);
        $s->update(['is_active' => !$s->is_active]);
        return response()->json(['success'=>true,'status'=>$s->is_active]);
    }
}
