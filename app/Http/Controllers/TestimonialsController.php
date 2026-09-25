<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        return view('pages.testimonials', compact('testimonials'));
    }
}
