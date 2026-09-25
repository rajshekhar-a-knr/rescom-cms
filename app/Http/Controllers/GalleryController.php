<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryItem::where('is_active', 1)->orderBy('sort_order')->orderBy('created_at', 'desc');
        if ($request->category) {
            $query->where('category', $request->category);
        }

        $items = $query->get();
        $categories = GalleryItem::where('is_active', 1)
            ->whereNotNull('category')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        return view('pages.gallery', compact('items', 'categories'));
    }
}
