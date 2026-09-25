<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller {
    public function index(Request $request) {
        $query = Portfolio::with('category')->where('is_active',1);
        if ($request->category) $query->whereHas('category',fn($q)=>$q->where('slug',$request->category));
        $portfolios = $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->paginate(12);
        $categories = PortfolioCategory::where('is_active',1)->withCount(['portfolios'=>fn($q)=>$q->where('is_active',1)])->orderBy('sort_order', 'asc')->get();
        return view('pages.portfolio', compact('portfolios','categories'));
    }
    public function show($slug) {
        $project = Portfolio::with('category')->where('slug',$slug)->where('is_active',1)->firstOrFail();
        $related = Portfolio::where('id','!=',$project->id)->where('is_active',1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(3)->get();
        return view('pages.portfolio-detail', compact('project','related'));
    }
}
