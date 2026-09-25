<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroBanner;

class HeroBannerController extends Controller {
    public function index() {
        $banners = HeroBanner::orderBy('sort_order')->get();
        return view('admin.pages.banners.index', compact('banners'));
    }
    public function create() { return view('admin.pages.banners.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'btn1_text' => 'nullable|string|max:100',
            'btn1_url' => 'nullable|url|max:255',
            'btn2_text' => 'nullable|string|max:100',
            'btn2_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active',true);
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'banners');
        }
        HeroBanner::create($data);
        return redirect()->route('admin.banners.index')->with('success','Banner created!');
    }
    public function edit(HeroBanner $banner) { return view('admin.pages.banners.form', compact('banner')); }
    public function update(Request $request, HeroBanner $banner) {
        $data = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'btn1_text' => 'nullable|string|max:100',
            'btn1_url' => 'nullable|url|max:255',
            'btn2_text' => 'nullable|string|max:100',
            'btn2_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'banners');
        }
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success','Banner updated!');
    }
    public function destroy(HeroBanner $banner) {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success','Banner deleted!');
    }
    public function toggle($id) {
        $b = HeroBanner::findOrFail($id);
        $b->update(['is_active'=>!$b->is_active]);
        return response()->json(['success'=>true]);
    }
    public function reorder(Request $request) {
        foreach ($request->order as $idx => $id) {
            HeroBanner::where('id',$id)->update(['sort_order'=>$idx+1]);
        }
        return response()->json(['success'=>true]);
    }
}
