<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogAdminController extends Controller {
    public function index() {
        $posts = BlogPost::with('category','author')->orderBy('created_at','desc')->paginate(20);
        return view('admin.pages.blog.index', compact('posts'));
    }
    public function create() {
        $categories = BlogCategory::orderBy('sort_order')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.pages.blog.form', compact('categories','tags'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1|max:120',
            'status' => 'nullable|in:published,draft,archived',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'featured_image' => 'nullable|image|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:blog_tags,id',
        ]);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);
        $data['author_id'] = Auth::id();
        $data['is_featured'] = $request->boolean('is_featured');
        if ($request->status === 'published' && !$request->published_at) $data['published_at'] = now();
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'blog');
        }
        $post = BlogPost::create($data);
        if ($request->tags) $post->tags()->sync($request->tags);
        return redirect()->route('admin.blog.index')->with('success','Blog post created!');
    }
    public function edit(BlogPost $blog) {
        $categories = BlogCategory::orderBy('sort_order')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.pages.blog.form', ['post'=>$blog, 'categories'=>$categories, 'tags'=>$tags]);
    }
    public function update(Request $request, BlogPost $blog) {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1|max:120',
            'status' => 'nullable|in:published,draft,archived',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'featured_image' => 'nullable|image|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:blog_tags,id',
        ]);
        $data['is_featured'] = $request->boolean('is_featured');
        if ($request->status === 'published' && !$blog->published_at) $data['published_at'] = now();
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = upload_to_storage($request->file('featured_image'), 'blog');
        }
        $blog->update($data);
        if ($request->tags) $blog->tags()->sync($request->tags);
        return redirect()->route('admin.blog.index')->with('success','Blog post updated!');
    }
    public function destroy(BlogPost $blog) {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success','Post deleted!');
    }
    public function toggle($id) {
        $p = BlogPost::findOrFail($id);
        $newStatus = $p->status === 'published' ? 'draft' : 'published';
        $p->update(['status'=>$newStatus,'published_at'=>$newStatus==='published'?now():$p->published_at]);
        return response()->json(['success'=>true]);
    }
}
