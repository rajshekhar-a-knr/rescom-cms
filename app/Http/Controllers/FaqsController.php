<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Faq::where('is_active', 1)
            ->whereNotNull('category')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $query = Faq::where('is_active', 1);
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $faqs = $query->orderBy('sort_order')->get();

        return view('pages.faqs', compact('faqs','categories'));
    }
}
