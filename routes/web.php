<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\PortfolioAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\CareersAdminController;
use App\Http\Controllers\Admin\CareerBenefitController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\PageController as PublicPageController;
use App\Http\Controllers\Admin\TopScrollerController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\LegalPageController as AdminLegalPageController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\Admin\ChatbotController as AdminChatbotController;
use App\Http\Controllers\Admin\InternController as AdminInternController;
use App\Http\Controllers\TeamController as PublicTeamController;
use App\Http\Controllers\DemoProductController;
use App\Http\Controllers\Admin\DemoProductController as AdminDemoProductController;
use App\Http\Controllers\DigitalCardController;
use App\Http\Controllers\PresentationController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team/{team}', [PublicTeamController::class, 'show'])->name('team.show');

Route::prefix('card')->name('digital-card.')->group(function () {
    Route::get('/{slug}', [DigitalCardController::class, 'show'])->name('show');
    Route::get('/{slug}/vcf', [DigitalCardController::class, 'downloadVcf'])->name('vcf');
    Route::get('/{slug}/pdf', [DigitalCardController::class, 'downloadPdf'])->name('pdf');
    Route::get('/{slug}/qr.svg', [DigitalCardController::class, 'qrCode'])->name('qr');
    Route::get('/{slug}/qr.png', [DigitalCardController::class, 'qrCode'])->name('qr.png');
});

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Careers
Route::get('/careers', [CareersController::class, 'index'])->name('careers');
Route::get('/careers/{slug}', [CareersController::class, 'show'])->name('careers.show');
Route::post('/careers/{id}/apply', [CareersController::class, 'apply'])->middleware('throttle:5,1')->name('careers.apply');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:5,1')->name('contact.submit');

// Product Demo Requests & Presentations
Route::get('/request-demo', [DemoProductController::class, 'index'])->name('demo-products.index');
Route::post('/request-demo/{demoProduct}', [DemoProductController::class, 'requestAccess'])->name('demo-products.request');
Route::get('/presentations/{slug}', [PresentationController::class, 'show'])->where('slug', '.*')->name('presentation.show');
Route::get('/presentation/{slug}', [PresentationController::class, 'show'])->where('slug', '.*')->name('presentation.single');
Route::get('/rescom-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('rescom.presentation');
Route::get('/knr-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('knr.presentation');
Route::get('/corporate-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('corporate.presentation');

// Gallery & Events
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/internship', [InternshipController::class, 'index'])->name('internship');
Route::get('/interns/{intern}', [InternshipController::class, 'show'])->name('internship.show');
Route::post('/internship/testimonials', [InternshipController::class, 'storeTestimonial'])->middleware('throttle:5,1')->name('internship.testimonials.store');
Route::post('/interns/{intern}/certificate/{token}/verify', [InternshipController::class, 'verifyCertificateEmail'])->middleware('throttle:6,1')->name('internship.certificate.verify');
Route::get('/interns/{intern}/certificate/{token}', [InternshipController::class, 'downloadCertificate'])->name('internship.certificate.download');
Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials');
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.page');

// Newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribe'])->middleware('throttle:3,1')->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe', [HomeController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Search (AJAX)
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

// Pages
Route::get('/privacy-policy', [LegalPageController::class, 'show'])->defaults('slug','privacy-policy')->name('privacy');
Route::get('/terms-of-service', [LegalPageController::class, 'show'])->defaults('slug','terms-and-conditions')->name('terms');
Route::get('/legal/{slug}', [LegalPageController::class, 'show'])->name('legal.show');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/sitemap', [HomeController::class, 'sitemapPage'])->name('sitemap.page');
Route::get('/page/{slug}', [PublicPageController::class, 'show'])->name('page.show');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'perm'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hero Banners
    Route::resource('banners', HeroBannerController::class);
    Route::post('banners/{id}/toggle', [HeroBannerController::class, 'toggle'])->name('banners.toggle');
    Route::post('banners/reorder', [HeroBannerController::class, 'reorder'])->name('banners.reorder');

    // Services
    Route::resource('services', ServiceAdminController::class);
    Route::post('services/{id}/toggle', [ServiceAdminController::class, 'toggle'])->name('services.toggle');

    // Portfolio
    Route::resource('portfolio', PortfolioAdminController::class);
    Route::post('portfolio/{id}/toggle', [PortfolioAdminController::class, 'toggle'])->name('portfolio.toggle');

    // Demo Products
    Route::resource('demo-products', AdminDemoProductController::class)->except('show');
    Route::post('demo-products/{demoProduct}/toggle', [AdminDemoProductController::class, 'toggle'])->name('demo-products.toggle');

    // Blog
    Route::resource('blog', BlogAdminController::class);
    Route::post('blog/{id}/toggle', [BlogAdminController::class, 'toggle'])->name('blog.toggle');

    // Team
    Route::resource('team', TeamController::class);
    Route::post('team/{id}/toggle', [TeamController::class, 'toggle'])->name('team.toggle');

    // Interns
    Route::resource('interns', AdminInternController::class);
    Route::post('interns/{id}/toggle', [AdminInternController::class, 'toggle'])->name('interns.toggle');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{id}/toggle', [TestimonialController::class, 'toggle'])->name('testimonials.toggle');

    // Clients
    Route::resource('clients', ClientController::class);

    // Stats
    Route::resource('stats', StatsController::class);

    // FAQs
    Route::resource('faqs', FaqController::class);

    // Gallery
    Route::post('gallery/reorder', [AdminGalleryController::class, 'reorder'])->name('gallery.reorder');
    Route::resource('gallery', AdminGalleryController::class);

    // Events
    Route::resource('events', AdminEventController::class);

    // Technologies
    Route::resource('technologies', TechnologyController::class);

    // Pages
    Route::get('pages/{page}/preview', [PageController::class, 'preview'])->name('pages.preview');
    Route::resource('pages', PageController::class);
    Route::resource('legal-pages', AdminLegalPageController::class);

    // About Page
    Route::resource('about', AboutPageController::class);

    // Careers / Jobs
    Route::resource('jobs', CareersAdminController::class);
    Route::get('job-applications', [CareersAdminController::class, 'applications'])->name('jobs.applications');
    Route::get('job-applications/{id}', [CareersAdminController::class, 'applicationShow'])->name('jobs.application.show');
    Route::post('job-applications/{id}/status', [CareersAdminController::class, 'updateStatus'])->name('jobs.application.status');
    Route::resource('career-benefits', CareerBenefitController::class);

    // Contacts / Inquiries
    Route::get('contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [ContactAdminController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{id}/status', [ContactAdminController::class, 'updateStatus'])->name('contacts.status');
    Route::delete('contacts/{id}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');
    Route::post('contacts/{id}/reply', [ContactAdminController::class, 'reply'])->name('contacts.reply');

    // Media Library
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    Route::get('media/browse', [MediaController::class, 'browse'])->name('media.browse');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('settings/header', [SettingsController::class, 'header'])->name('settings.header');
    Route::get('settings/footer', [SettingsController::class, 'footer'])->name('settings.footer');
    Route::post('settings/menu-items', [SettingsController::class, 'storeMenuItem'])->name('settings.menu-items.store');
    Route::put('settings/menu-items/{menuItem}', [SettingsController::class, 'updateMenuItem'])->name('settings.menu-items.update');
    Route::delete('settings/menu-items/{menuItem}', [SettingsController::class, 'destroyMenuItem'])->name('settings.menu-items.destroy');
    Route::post('settings/menu-items/{menuItem}/toggle', [SettingsController::class, 'toggleMenuItem'])->name('settings.menu-items.toggle');
    Route::post('settings/menu-items/reorder', [SettingsController::class, 'reorderMenuItems'])->name('settings.menu-items.reorder');
    Route::post('settings/menu-items/reset/{location}', [SettingsController::class, 'resetMenuItems'])->name('settings.menu-items.reset');
    Route::get('settings/content', [SettingsController::class, 'content'])->name('settings.content');
    Route::get('settings/seo', [SettingsController::class, 'seo'])->name('settings.seo');
    Route::get('settings/social', [SettingsController::class, 'social'])->name('settings.social');
    Route::get('settings/email', [SettingsController::class, 'email'])->name('settings.email');
    Route::get('settings/top-scroller', [TopScrollerController::class, 'index'])->name('settings.topscroller');
    Route::post('settings/top-scroller', [TopScrollerController::class, 'store'])->name('settings.topscroller.store');
    Route::get('settings/top-scroller/{topScroller}/edit', [TopScrollerController::class, 'edit'])->name('settings.topscroller.edit');
    Route::put('settings/top-scroller/{topScroller}', [TopScrollerController::class, 'update'])->name('settings.topscroller.update');
    Route::delete('settings/top-scroller/{topScroller}', [TopScrollerController::class, 'destroy'])->name('settings.topscroller.destroy');
    Route::post('settings/top-scroller/{topScroller}/toggle', [TopScrollerController::class, 'toggle'])->name('settings.topscroller.toggle');

    // Users Management
    Route::resource('users', UserController::class);
    Route::post('users/{id}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('users/{user}/reset-password', [UserController::class, 'updatePassword'])->name('users.update-password');

    // Permissions / Rights
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('permissions/{role}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/user/{user}', [PermissionController::class, 'updateUser'])->name('permissions.user.update');

    // Newsletter
    Route::get('newsletter', [DashboardController::class, 'newsletter'])->name('newsletter');
    Route::post('newsletter/export', [DashboardController::class, 'exportNewsletter'])->name('newsletter.export');

    // Activity Logs
    Route::get('activity-logs', [DashboardController::class, 'activityLogs'])->name('activity-logs');
    Route::get('website-visits', [DashboardController::class, 'websiteVisits'])->name('website-visits');
    Route::get('website-visits/export', [DashboardController::class, 'exportWebsiteVisits'])->name('website-visits.export');
    Route::get('website-visits/stream', [DashboardController::class, 'websiteVisitsStream'])->name('website-visits.stream');

    // Chatbot
    Route::get('chatbot', [AdminChatbotController::class, 'index'])->name('chatbot.index');
    Route::get('chatbot/create', [AdminChatbotController::class, 'create'])->name('chatbot.create');
    Route::post('chatbot', [AdminChatbotController::class, 'store'])->name('chatbot.store');
    Route::get('chatbot/{chatbot}/edit', [AdminChatbotController::class, 'edit'])->name('chatbot.edit');
    Route::put('chatbot/{chatbot}', [AdminChatbotController::class, 'update'])->name('chatbot.update');
    Route::delete('chatbot/{chatbot}', [AdminChatbotController::class, 'destroy'])->name('chatbot.destroy');
    Route::post('chatbot/{chatbot}/toggle', [AdminChatbotController::class, 'toggle'])->name('chatbot.toggle');

    Route::get('chatbot/queries', [AdminChatbotController::class, 'queries'])->name('chatbot.queries');
    Route::post('chatbot/queries/{query}/respond', [AdminChatbotController::class, 'respond'])->name('chatbot.queries.respond');
    Route::post('chatbot/queries/{query}/convert', [AdminChatbotController::class, 'convert'])->name('chatbot.queries.convert');
    Route::post('chatbot/settings', [AdminChatbotController::class, 'settings'])->name('chatbot.settings');
});
