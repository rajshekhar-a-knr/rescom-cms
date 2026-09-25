<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller {
    public function index(Request $request) {
        $query = Service::with('category')->where('is_active', 1);
        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        $services = $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->paginate(12)->withQueryString();
        $categories = ServiceCategory::where('is_active', 1)
            ->withCount(['services' => fn($q) => $q->where('is_active', 1)])
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.services', compact('services', 'categories'));
    }
    public function show($slug) {
        $service = Service::with('category')->where('slug',$slug)->where('is_active',1)->firstOrFail();
        $related = Service::where('id','!=',$service->id)
            ->where('is_active',1)
            ->where('category_id',$service->category_id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->take(4)
            ->get();
        return view('pages.service-detail', compact('service','related'));
    }
}
