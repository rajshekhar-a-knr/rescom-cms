<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class BlogController extends Controller {
    public function index(Request $request) {
        $query = BlogPost::with('category','author')->where('status','published');
        if ($request->search) $query->where('title','like','%'.$request->search.'%');
        if ($request->filled('category')) {
            $activeCategory = BlogCategory::where('slug', $request->category)->first();
            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }
        $posts = $query->orderBy('published_at','desc')->paginate(9);
        $categories = BlogCategory::withCount(['posts'=>fn($q)=>$q->where('status','published')])->get();
        $recentPosts = BlogPost::where('status','published')->orderBy('published_at','desc')->take(5)->get();
        $tags = BlogTag::withCount('posts')->orderBy('posts_count','desc')->take(20)->get();
        return view('pages.blog', compact('posts','categories','recentPosts','tags'));
    }
    public function show($slug) {
        $post = BlogPost::with('category','author','tags')->where('slug',$slug)->where('status','published')->firstOrFail();
        $post->increment('views');
        $related = BlogPost::where('category_id',$post->category_id)->where('id','!=',$post->id)->where('status','published')->take(3)->get();
        return view('pages.blog-detail', compact('post','related'));
    }
    public function category($slug) {
        $category = BlogCategory::where('slug',$slug)->firstOrFail();
        $posts = BlogPost::with('author')->where('category_id',$category->id)->where('status','published')->orderBy('published_at','desc')->paginate(9);
        return view('pages.blog-category', compact('category','posts'));
    }
    public function tag($slug) {
        $tag = BlogTag::where('slug',$slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->where('status','published')->orderBy('published_at','desc')->paginate(9);
        return view('pages.blog-tag', compact('tag','posts'));
    }
}
