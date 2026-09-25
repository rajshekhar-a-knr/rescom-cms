<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Str;

class PortfolioAdminController extends Controller {
    public function index() {
        $portfolios = Portfolio::with('category')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->paginate(20);
        return view('admin.pages.portfolio.index', compact('portfolios'));
    }
    public function create() {
        $categories = PortfolioCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.pages.portfolio.form', compact('categories'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'results' => 'nullable|string',
            'technologies_raw' => 'nullable|string|max:2000',
            'project_url' => 'nullable|url|max:255',
            'completion_date' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'featured_image' => 'nullable|image|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['sort_order'] = (int) ($request->input('sort_order', 0));
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'portfolio');
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file) {
                    $gallery[] = upload_to_storage($file, 'portfolio/gallery');
                }
            }
        }
        $data['gallery'] = !empty($gallery) ? $gallery : null;

        if ($request->technologies_raw) $data['technologies'] = array_filter(explode("\n", $request->technologies_raw));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $created = Portfolio::create($data);

        // Keep Demo Product sorting order in sync
        \App\Models\DemoProduct::where('slug', $created->slug)
            ->orWhere('title', $created->title)
            ->update(['sort_order' => $created->sort_order]);

        return redirect()->route('admin.portfolio.index')->with('success','Project added!');
    }
    public function edit(Portfolio $portfolio) {
        $categories = PortfolioCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.pages.portfolio.form', compact('portfolio','categories'));
    }
    public function update(Request $request, Portfolio $portfolio) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'results' => 'nullable|string',
            'technologies_raw' => 'nullable|string|max:2000',
            'project_url' => 'nullable|url|max:255',
            'completion_date' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'featured_image' => 'nullable|image|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:10240',
            'delete_gallery' => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        $data['slug'] = Str::slug($request->title);
        $data['sort_order'] = (int) ($request->input('sort_order', 0));
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'portfolio');
        }

        // Manage existing & new gallery images
        $existingGallery = is_array($portfolio->gallery) ? $portfolio->gallery : (json_decode($portfolio->gallery, true) ?: []);
        
        // Remove marked images
        if ($request->has('delete_gallery') && is_array($request->delete_gallery)) {
            $deleteIndices = array_map('intval', $request->delete_gallery);
            foreach ($deleteIndices as $idx) {
                if (isset($existingGallery[$idx])) {
                    unset($existingGallery[$idx]);
                }
            }
            $existingGallery = array_values($existingGallery);
        }

        // Append new images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file) {
                    $existingGallery[] = upload_to_storage($file, 'portfolio/gallery');
                }
            }
        }
        $data['gallery'] = !empty($existingGallery) ? array_values($existingGallery) : null;

        if ($request->technologies_raw) $data['technologies'] = array_filter(explode("\n", $request->technologies_raw));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $portfolio->update($data);

        // Keep Demo Product sorting order in sync
        \App\Models\DemoProduct::where('slug', $portfolio->slug)
            ->orWhere('title', $portfolio->title)
            ->update(['sort_order' => $portfolio->sort_order]);

        return redirect()->route('admin.portfolio.index')->with('success','Project updated!');
    }
    public function destroy(Portfolio $portfolio) {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success','Project deleted!');
    }
    public function toggle($id) {
        $p = Portfolio::findOrFail($id);
        $p->update(['is_active' => !$p->is_active]);
        return response()->json(['success'=>true]);
    }
}
