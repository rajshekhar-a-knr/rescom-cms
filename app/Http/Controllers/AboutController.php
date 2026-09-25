<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Stat;
use App\Models\Client;
use App\Models\Technology;
use App\Models\AboutPage;

class AboutController extends Controller {
    public function index() {
        $about = AboutPage::where('is_active', 1)->orderBy('sort_order')->orderBy('id','desc')->first();
        return view('pages.about', [
            'about'        => $about,
            'team'         => TeamMember::where('is_active',1)->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_active',1)->orderBy('sort_order')->take(6)->get(),
            'stats'        => Stat::where('is_active',1)->orderBy('sort_order')->get(),
            'clients'      => Client::where('is_active',1)->orderBy('sort_order')->get(),
            'technologies' => Technology::where('is_active',1)->orderBy('sort_order')->get(),
        ]);
    }
}
