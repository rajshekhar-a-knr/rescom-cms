<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Models\LegalPage;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\JobListing;
use App\Models\Intern;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $results = [
            'Site' => [],
            'Pages' => [],
            'Legal' => [],
            'Services' => [],
            'Products' => [],
            'Blog' => [],
            'Events' => [],
            'Gallery' => [],
            'Careers' => [],
        ];

        if ($q !== '') {
            $staticLinks = [
                ['title' => 'Home', 'url' => route('home'), 'keywords' => ['home', 'index', 'landing']],
                ['title' => 'About', 'url' => route('about'), 'keywords' => ['about', 'company', 'team']],
                ['title' => 'Services', 'url' => route('services'), 'keywords' => ['services', 'service', 'offerings']],
                ['title' => 'Products', 'url' => route('portfolio'), 'keywords' => ['products', 'portfolio', 'work', 'projects']],
                ['title' => 'Events', 'url' => route('events'), 'keywords' => ['events', 'event']],
                ['title' => 'Gallery', 'url' => route('gallery'), 'keywords' => ['gallery', 'photos', 'images']],
                ['title' => 'Testimonials', 'url' => route('testimonials'), 'keywords' => ['testimonials', 'reviews', 'clients']],
                ['title' => 'Blogs', 'url' => route('blog'), 'keywords' => ['blog', 'blogs', 'articles', 'news']],
                ['title' => 'FAQs', 'url' => route('faqs.page'), 'keywords' => ['faqs', 'faq', 'questions']],
                ['title' => 'Careers', 'url' => route('careers'), 'keywords' => ['careers', 'jobs', 'hiring']],
                ['title' => 'Contact', 'url' => route('contact'), 'keywords' => ['contact', 'support', 'help']],
                ['title' => 'Internship', 'url' => route('internship'), 'keywords' => ['internship', 'interns', 'alumni', 'current intern']],
            ];

            $needle = Str::lower($q);
            $results['Site'] = collect($staticLinks)
                ->filter(function ($item) use ($needle) {
                    if (str_contains(Str::lower($item['title']), $needle)) return true;
                    foreach ($item['keywords'] as $kw) {
                        if (str_contains(Str::lower($kw), $needle)) return true;
                    }
                    return false;
                })
                ->map(fn($item) => [
                    'title' => $item['title'],
                    'snippet' => 'Quick link',
                    'url' => $item['url'],
                ])->values()->all();

            $like = '%' . $q . '%';

            $pages = Page::where('status', 'published')
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('excerpt', 'like', $like)
                        ->orWhere('content', 'like', $like);
                })
                ->orderBy('published_at', 'desc')
                ->take(8)
                ->get();
            $results['Pages'] = $pages->map(fn($p) => [
                'title' => $p->title,
                'snippet' => Str::limit(strip_tags($p->excerpt ?? $p->content ?? ''), 140),
                'url' => route('page.show', $p->slug),
            ])->all();

            $legal = LegalPage::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('content', 'like', $like);
                })
                ->orderBy('sort_order')
                ->take(6)
                ->get();
            $results['Legal'] = $legal->map(fn($p) => [
                'title' => $p->title,
                'snippet' => Str::limit(strip_tags($p->content ?? ''), 140),
                'url' => route('legal.show', $p->slug),
            ])->all();

            $services = Service::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('short_description', 'like', $like)
                        ->orWhere('description', 'like', $like);
                })
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'asc')
                ->take(8)
                ->get();
            $results['Services'] = $services->map(fn($s) => [
                'title' => $s->title,
                'snippet' => Str::limit(strip_tags($s->short_description ?? $s->description ?? ''), 140),
                'url' => route('services.show', $s->slug),
            ])->all();

            $portfolios = Portfolio::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('short_description', 'like', $like)
                        ->orWhere('description', 'like', $like)
                        ->orWhere('client_name', 'like', $like);
                })
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'asc')
                ->take(8)
                ->get();
            $results['Products'] = $portfolios->map(fn($p) => [
                'title' => $p->title,
                'snippet' => Str::limit(strip_tags($p->short_description ?? $p->description ?? ''), 140),
                'url' => route('portfolio.show', $p->slug),
            ])->all();

            $posts = BlogPost::where('status', 'published')
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('excerpt', 'like', $like)
                        ->orWhere('content', 'like', $like);
                })
                ->orderBy('published_at', 'desc')
                ->take(8)
                ->get();
            $results['Blog'] = $posts->map(fn($p) => [
                'title' => $p->title,
                'snippet' => Str::limit(strip_tags($p->excerpt ?? $p->content ?? ''), 140),
                'url' => route('blog.show', $p->slug),
            ])->all();

            $events = Event::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('summary', 'like', $like)
                        ->orWhere('description', 'like', $like)
                        ->orWhere('location', 'like', $like);
                })
                ->orderBy('event_date', 'desc')
                ->take(6)
                ->get();
            $results['Events'] = $events->map(fn($e) => [
                'title' => $e->title,
                'snippet' => Str::limit(strip_tags($e->summary ?? $e->description ?? ''), 140),
                'url' => route('events.show', $e->slug),
            ])->all();

            $gallery = GalleryItem::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('caption', 'like', $like)
                        ->orWhere('category', 'like', $like);
                })
                ->orderBy('sort_order')
                ->take(8)
                ->get();
            $results['Gallery'] = $gallery->map(fn($g) => [
                'title' => $g->title ?? 'Gallery item',
                'snippet' => Str::limit(strip_tags($g->caption ?? $g->category ?? ''), 140),
                'url' => route('gallery', ['category' => $g->category]),
            ])->all();

            $jobs = JobListing::where('status', 'open')
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('department', 'like', $like)
                        ->orWhere('location', 'like', $like)
                        ->orWhere('description', 'like', $like)
                        ->orWhere('requirements', 'like', $like);
                })
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
            $results['Careers'] = $jobs->map(fn($j) => [
                'title' => $j->title,
                'snippet' => Str::limit(strip_tags($j->location ?? $j->department ?? ''), 140),
                'url' => route('careers.show', $j->slug),
            ])->all();

            $interns = Intern::where('is_active', 1)
                ->where(function ($query) use ($like) {
                    $query->where('name', 'like', $like)
                        ->orWhere('designation', 'like', $like)
                        ->orWhere('bio', 'like', $like);
                })
                ->orderBy('sort_order')
                ->take(8)
                ->get();
            $results['Interns'] = $interns->map(fn($i) => [
                'title' => $i->name,
                'snippet' => Str::limit(strip_tags($i->designation ?? $i->bio ?? ''), 140),
                'url' => route('internship.show', $i),
            ])->all();
        }

        $sections = [];
        foreach ($results as $title => $items) {
            if (!empty($items)) {
                $sections[] = ['title' => $title, 'items' => array_values($items)];
            }
        }

        return response()->json([
            'query' => $q,
            'total' => collect($results)->flatten(1)->count(),
            'sections' => $sections,
        ]);
    }
}
