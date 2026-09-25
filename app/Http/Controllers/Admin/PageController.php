<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller {
    public function index() { $pages = Page::orderBy('sort_order')->paginate(20); return view('admin.pages.pages.index', compact('pages')); }
    public function create() { return view('admin.pages.pages.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'nullable|in:published,draft',
            'template' => 'nullable|in:default,full-width,sidebar',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:5120',
            'show_in_header' => 'nullable|boolean',
            'show_in_footer' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['slug'] = $this->makeUniqueSlug($data['slug'] ?? Str::slug($request->title));
        $data['author_id'] = Auth::id();
        $data['status'] = $request->status ?? 'published';
        $data['show_in_header'] = $request->boolean('show_in_header');
        $data['show_in_footer'] = $request->boolean('show_in_footer');
        $data['sort_order'] = $request->input('sort_order', 0);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'pages');
        }
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success','Page created!');
    }
    public function edit(Page $page) { return view('admin.pages.pages.form', compact('page')); }
    public function update(Request $request, Page $page) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'nullable|in:published,draft',
            'template' => 'nullable|in:default,full-width,sidebar',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:5120',
            'show_in_header' => 'nullable|boolean',
            'show_in_footer' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['slug'] = $data['slug'] ? $data['slug'] : Str::slug($request->title);
        $data['slug'] = $this->makeUniqueSlug($data['slug'], $page->id);
        $data['show_in_header'] = $request->boolean('show_in_header');
        $data['show_in_footer'] = $request->boolean('show_in_footer');
        $data['sort_order'] = $request->input('sort_order', $page->sort_order ?? 0);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'pages');
        }
        $page->update($data);
        return redirect()->route('admin.pages.index')->with('success','Page updated!');
    }
    public function destroy(Page $page) { $page->delete(); return redirect()->route('admin.pages.index')->with('success','Page deleted!'); }

    public function preview(Page $page)
    {
        return view('pages.page', ['page' => $page, 'isPreview' => true]);
    }

    private function makeUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $counter = 2;
        while (Page::where('slug', $candidate)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $base . '-' . $counter;
            $counter++;
        }
        return $candidate;
    }
}
