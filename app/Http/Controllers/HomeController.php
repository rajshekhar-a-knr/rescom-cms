<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroBanner;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Stat;
use App\Models\Client;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Technology;
use App\Models\NewsletterSubscriber;
use App\Models\Event;
use App\Services\EmailService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    protected EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function index()
    {
        $heroBanners = HeroBanner::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $featuredServices = Service::with('category')->where('is_active', 1)->where('is_featured', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        if ($featuredServices->isEmpty()) {
            $featuredServices = Service::with('category')->where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(6)->get();
        }
        $featuredPortfolios = Portfolio::with('category')->where('is_active', 1)->where('is_featured', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        if ($featuredPortfolios->isEmpty()) {
            $featuredPortfolios = Portfolio::with('category')->where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(8)->get();
        }
        $testimonials = Testimonial::where('is_active', 1)->where('is_featured', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(6)->get();
        $team = TeamMember::where('is_active', 1)->where('is_featured', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(6)->get();
        $stats = Stat::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $featuredClients = Client::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(12)->get();
        $latestBlogs = BlogPost::with('category')->where('status', 'published')->where('is_featured', 1)->orderBy('published_at', 'desc')->get();
        if ($latestBlogs->isEmpty()) {
            $latestBlogs = BlogPost::with('category')->where('status', 'published')->orderBy('published_at', 'desc')->take(10)->get();
        }
        $faqs = Faq::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->take(8)->get();
        $technologies = Technology::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();

        return view('pages.home', [
            // Names expected by resources/views/pages/home.blade.php
            'heroBanners' => $heroBanners,
            'featuredServices' => $featuredServices,
            'featuredPortfolios' => $featuredPortfolios,
            'featuredClients' => $featuredClients,
            'latestBlogs' => $latestBlogs,
            'testimonials' => $testimonials,
            'team' => $team,
            'stats' => $stats,
            'faqs' => $faqs,
            'technologies' => $technologies,

            // Backward-compatible aliases
            'banners' => $heroBanners,
            'services' => $featuredServices,
            'portfolio' => $featuredPortfolios,
            'clients' => $featuredClients,
            'latestPosts' => $latestBlogs,
        ]);
    }

    public function newsletter(Request $request)
    {
        $previousUrl = url()->previous();
        $separator = str_contains($previousUrl, '?') ? '&' : '?';
        $rejectNewsletter = fn () => redirect($previousUrl . $separator . 'newsletter=info#newsletter')
            ->with('newsletter_info', 'We could not process that subscription. Please try again.')
            ->withInput()
            ->with('newsletter_code', 'info');

        $startedAt = (int) $request->input('newsletter_started_at', 0);
        $elapsedSeconds = time() - $startedAt;

        if ($request->filled('newsletter_website')
            || $startedAt <= 0
            || $elapsedSeconds < 2
            || $elapsedSeconds > 7200
        ) {
            Log::warning('Newsletter bot guard rejected request', [
                'ip' => $request->ip(),
                'reason' => 'honeypot_or_timing',
            ]);

            return $rejectNewsletter();
        }

        $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'newsletter_website' => ['nullable', 'max:0'],
            'newsletter_started_at' => ['required', 'integer'],
        ]);

        $email = mb_strtolower(trim((string) $request->email));
        $rateKey = 'newsletter_subscribe:' . sha1($request->ip() . '|' . $email);

        if (!Cache::add($rateKey, true, now()->addMinutes(10))) {
            Log::warning('Newsletter rate guard rejected request', [
                'ip' => $request->ip(),
                'email_hash' => sha1($email),
            ]);

            return $rejectNewsletter();
        }

        $existing = NewsletterSubscriber::where('email', $email)->first();

        if ($existing) {
            if ($existing->status === 'unsubscribed') {
                $existing->update(['status' => 'active']);
                $this->sendNewsletterThanks($email, true);
                return redirect($previousUrl . $separator . 'newsletter=success#newsletter')
                    ->with('newsletter_success', 'Welcome back! You are subscribed again.')
                    ->withInput()
                    ->with('newsletter_code', 'success');
            }
            return redirect($previousUrl . $separator . 'newsletter=info#newsletter')
                ->with('newsletter_info', 'You are already subscribed!')
                ->withInput()
                ->with('newsletter_code', 'info');
        }

        NewsletterSubscriber::create(['email' => $email, 'status' => 'active']);
        $this->sendNewsletterThanks($email, false);
        return redirect($previousUrl . $separator . 'newsletter=success#newsletter')
            ->with('newsletter_success', 'Thank you for subscribing!')
            ->withInput()
            ->with('newsletter_code', 'success');
    }

    public function subscribe(Request $request)
    {
        return $this->newsletter($request);
    }

    public function unsubscribe(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        $email = $request->query('email');
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->status !== 'unsubscribed') {
            $subscriber->update(['status' => 'unsubscribed']);
        }

        return view('pages.newsletter-unsubscribe', [
            'email' => $email,
            'status' => $subscriber?->status ?? 'not_found',
        ]);
    }

    public function sitemap()
    {
        $services   = Service::where('is_active', 1)->select('slug', 'updated_at')->get();
        $portfolios = Portfolio::where('is_active', 1)->select('slug', 'updated_at')->get();
        $blogs      = BlogPost::where('status', 'published')->select('slug', 'updated_at')->get();
        $events     = Event::where('is_active', 1)->select('slug', 'updated_at')->get();
        return response()->view('pages.sitemap', compact('services', 'portfolios', 'blogs', 'events'))->header('Content-Type', 'text/xml');
    }

    public function sitemapPage()
    {
        $services   = Service::where('is_active', 1)->select('slug')->get();
        $portfolios = Portfolio::where('is_active', 1)->select('slug')->get();
        $blogs      = BlogPost::where('status', 'published')->select('slug')->get();
        $events     = Event::where('is_active', 1)->select('slug')->get();
        return view('pages.sitemap-page', compact('services', 'portfolios', 'blogs', 'events'));
    }

    protected function sendNewsletterThanks(string $email, bool $returning): void
    {
        try {
            $siteName = setting('site_name', 'Rescom');
            $siteLogo = setting('site_logo');
            $subject = $returning
                ? "Welcome back to {$siteName} updates"
                : "Thanks for subscribing to {$siteName}";

            $unsubscribeUrl = URL::temporarySignedRoute(
                'newsletter.unsubscribe',
                now()->addDays(30),
                ['email' => $email]
            );

            $html = view('emails.newsletter-thankyou', [
                'siteName' => $siteName,
                'siteLogo' => $siteLogo,
                'isReturning' => $returning,
                'unsubscribeUrl' => $unsubscribeUrl,
            ])->render();

            $sent = $this->emailService->sendRawHtml($email, $subject, $html);
            Log::info('Newsletter email ' . ($sent ? 'sent' : 'failed') . ' to ' . $email, [
                'returning' => $returning,
            ]);
        } catch (\Throwable $e) {
            Log::error('Newsletter email failed', [
                'to' => $email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
