<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Services\SchoolStorageService;

class SettingsController extends Controller
{
    protected $storageService;
    protected $disk;

    public function __construct(SchoolStorageService $storageService)
    {
        $this->storageService = $storageService;
        $this->disk = 'custom'; 
    }

    public function index()
    {
        $settings = Setting::whereIn('group', ['general','contact'])
            ->orWhereNull('group')
            ->orWhere('group', '')
            ->get()
            ->keyBy('key');
        return view('admin.pages.settings.general', compact('settings'));
    }

    public function header()
    {
        $settings = Setting::where('group', 'header')->get()->keyBy('key');
        $headerMenu = Menu::firstOrCreate(['location' => 'header'], ['name' => 'Main Navigation', 'is_active' => 1]);
        $menuItems = MenuItem::with(['children' => fn($q) => $q->orderBy('sort_order')->orderBy('id')])
            ->where('menu_id', $headerMenu->id)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
        $parentMenuItems = MenuItem::where('menu_id', $headerMenu->id)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();
        return view('admin.pages.settings.header', compact('settings', 'headerMenu', 'menuItems', 'parentMenuItems'));
    }

    public function footer()
    {
        $settings = Setting::where('group', 'footer')->get()->keyBy('key');
        $footerMenu = Menu::firstOrCreate(['location' => 'footer'], ['name' => 'Footer Links', 'is_active' => 1]);
        $menuItems = MenuItem::where('menu_id', $footerMenu->id)->orderBy('section')->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.pages.settings.footer', compact('settings', 'footerMenu', 'menuItems'));
    }

    public function seo()
    {
        $settings = Setting::whereIn('group', ['seo','advanced'])->get()->keyBy('key');
        return view('admin.pages.settings.seo', compact('settings'));
    }

    public function content()
    {
        $settings = Setting::where('group', 'content')->get()->keyBy('key');
        return view('admin.pages.settings.content', compact('settings'));
    }

    public function social()
    {
        $settings = Setting::where('group', 'social')->get()->keyBy('key');
        return view('admin.pages.settings.social', compact('settings'));
    }

    public function email()
    {
        $settings = Setting::where('group', 'email')->get()->keyBy('key');
        return view('admin.pages.settings.email', compact('settings'));
    }

    public function storeMenuItem(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'target' => 'nullable|string|in:_self,_blank',
            'item_type' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['parent_id'] = !empty($validated['parent_id']) ? $validated['parent_id'] : null;
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['item_type'] = $validated['item_type'] ?? 'link';
        $validated['section'] = $validated['section'] ?? 'main';
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : true;

        if (!isset($validated['sort_order']) || $validated['sort_order'] === null) {
            $maxSort = MenuItem::where('menu_id', $validated['menu_id'])
                ->when($validated['parent_id'], fn($q) => $q->where('parent_id', $validated['parent_id']))
                ->when(!$validated['parent_id'] && isset($validated['section']), fn($q) => $q->where('section', $validated['section'])->whereNull('parent_id'))
                ->max('sort_order') ?? 0;
            $validated['sort_order'] = $maxSort + 1;
        }

        $item = MenuItem::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Menu item added successfully!', 'item' => $item]);
        }

        return back()->with('success', 'Menu item added successfully!');
    }

    public function updateMenuItem(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menu_items,id',
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'target' => 'nullable|string|in:_self,_blank',
            'item_type' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->has('parent_id')) {
            $validated['parent_id'] = !empty($validated['parent_id']) ? $validated['parent_id'] : null;
        }
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['item_type'] = $validated['item_type'] ?? ($menuItem->item_type ?? 'link');
        $validated['section'] = $validated['section'] ?? ($menuItem->section ?? 'main');
        if ($request->has('is_active')) {
            $validated['is_active'] = (bool) $request->input('is_active');
        }

        $menuItem->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Menu item updated successfully!', 'item' => $menuItem]);
        }

        return back()->with('success', 'Menu item updated successfully!');
    }

    public function destroyMenuItem(MenuItem $menuItem)
    {
        $title = $menuItem->title;
        // Also delete children if parent is deleted
        MenuItem::where('parent_id', $menuItem->id)->delete();
        $menuItem->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'message' => "\"{$title}\" removed successfully!"]);
        }

        return back()->with('success', "\"{$title}\" removed successfully!");
    }

    public function toggleMenuItem(MenuItem $menuItem)
    {
        $menuItem->is_active = !$menuItem->is_active;
        $menuItem->save();

        $status = $menuItem->is_active ? 'Active' : 'Inactive';
        $msg = "\"{$menuItem->title}\" is now {$status}.";

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $menuItem->is_active,
                'message' => $msg
            ]);
        }

        return back()->with('success', $msg);
    }

    public function reorderMenuItems(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($items as $index => $id) {
            MenuItem::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully!']);
    }

    public function resetMenuItems(Request $request, string $location)
    {
        $menu = Menu::firstOrCreate(['location' => $location], ['name' => ucfirst($location) . ' Navigation', 'is_active' => 1]);
        MenuItem::where('menu_id', $menu->id)->delete();

        if ($location === 'header') {
            $defaultHeaderTabs = [
                ['title' => 'About', 'url' => '/about', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 1, 'is_active' => 1],
                ['title' => 'Products', 'url' => '/portfolio', 'item_type' => 'dropdown_products', 'target' => '_self', 'badge_text' => null, 'sort_order' => 2, 'is_active' => 1],
                ['title' => 'Services', 'url' => '/services', 'item_type' => 'dropdown_services', 'target' => '_self', 'badge_text' => null, 'sort_order' => 3, 'is_active' => 1],
                ['title' => 'Resources', 'url' => '#', 'item_type' => 'dropdown_resources', 'target' => '_self', 'badge_text' => null, 'sort_order' => 4, 'is_active' => 1],
                ['title' => 'Careers', 'url' => '/careers', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 5, 'is_active' => 1],
                ['title' => 'Contact', 'url' => '/contact', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 6, 'is_active' => 1],
                ['title' => 'Presentation', 'url' => '/presentations/rescom-presentation', 'item_type' => 'presentation', 'target' => '_blank', 'badge_text' => 'Live', 'sort_order' => 7, 'is_active' => 1],
            ];
            foreach ($defaultHeaderTabs as $item) {
                $created = MenuItem::create(array_merge($item, ['menu_id' => $menu->id, 'section' => 'main']));
                if ($created->title === 'Resources') {
                    $resourcesSub = [
                        ['title' => 'Internship', 'url' => '/internship', 'sort_order' => 1, 'is_active' => 1],
                        ['title' => 'Events', 'url' => '/events', 'sort_order' => 2, 'is_active' => 1],
                        ['title' => 'Gallery', 'url' => '/gallery', 'sort_order' => 3, 'is_active' => 1],
                        ['title' => 'Blogs', 'url' => '/blog', 'sort_order' => 4, 'is_active' => 1],
                        ['title' => 'Testimonials', 'url' => '/testimonials', 'sort_order' => 5, 'is_active' => 1],
                        ['title' => 'FAQs', 'url' => '/faqs', 'sort_order' => 6, 'is_active' => 1],
                    ];
                    foreach ($resourcesSub as $sub) {
                        MenuItem::create(array_merge($sub, [
                            'menu_id' => $menu->id,
                            'parent_id' => $created->id,
                            'section' => 'main',
                            'item_type' => 'link',
                            'target' => '_self'
                        ]));
                    }
                }
            }
        } elseif ($location === 'footer') {
            $defaultFooterItems = [
                ['title' => 'Corporate Presentation', 'url' => '/presentations/rescom-presentation', 'item_type' => 'presentation', 'section' => 'company', 'target' => '_blank', 'badge_text' => 'Live', 'sort_order' => 1, 'is_active' => 1],
                ['title' => 'About Us', 'url' => '/about', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 2, 'is_active' => 1],
                ['title' => 'Our Products', 'url' => '/portfolio', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 3, 'is_active' => 1],
                ['title' => 'Blog & Insights', 'url' => '/blog', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 4, 'is_active' => 1],
                ['title' => 'Gallery', 'url' => '/gallery', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 5, 'is_active' => 1],
                ['title' => 'Events', 'url' => '/events', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 6, 'is_active' => 1],
                ['title' => 'Careers', 'url' => '/careers', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 7, 'is_active' => 1],
                ['title' => 'Contact Us', 'url' => '/contact', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 8, 'is_active' => 1],

                ['title' => 'Privacy Policy', 'url' => '/privacy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 1, 'is_active' => 1],
                ['title' => 'Website Terms and Conditions', 'url' => '/terms', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 2, 'is_active' => 1],
                ['title' => 'Anti-SPAM Policy', 'url' => '/legal/anti-spam-policy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 3, 'is_active' => 1],
                ['title' => 'License Agreement', 'url' => '/legal/license-agreement', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 4, 'is_active' => 1],
                ['title' => 'Cookies Policy', 'url' => '/legal/cookies-policy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 5, 'is_active' => 1],
            ];
            foreach ($defaultFooterItems as $item) {
                MenuItem::create(array_merge(['menu_id' => $menu->id, 'target' => '_self'], $item));
            }
        }

        return back()->with('success', ucfirst($location) . ' navigation reset to standard defaults!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string',
            'site_description' => 'nullable|string|max:1000',
            'footer_about' => 'nullable|string|max:1000',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => ['nullable','string','max:25','regex:/^(?=(?:\\D*\\d){10,15}\\D*$)[0-9\\s\\+\\-\\(\\)]+$/'],
            'contact_phone2' => ['nullable','string','max:25','regex:/^(?=(?:\\D*\\d){10,15}\\D*$)[0-9\\s\\+\\-\\(\\)]+$/'],
            'whatsapp_number' => ['nullable','string','max:25','regex:/^(?=(?:\\D*\\d){10,15}\\D*$)[0-9\\s\\+\\-\\(\\)]+$/'],
            'contact_address' => 'nullable|string|max:500',
            'business_hours' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|max:5120',
            'site_favicon' => 'nullable|image|max:2048',
            'meta_title_suffix' => 'nullable|string|max:100',
            'analytics_code' => 'nullable|string|max:5000',
            'recaptcha_site_key' => 'nullable|string|max:255',
            'recaptcha_secret_key' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_github' => 'nullable|url|max:255',
            'topbar_enabled' => 'nullable|boolean',
            'top_scroller_speed' => 'nullable|integer|min:6|max:120',
            'topbar_left_text' => 'nullable|string|max:255',
            'topbar_right_text' => 'nullable|string|max:255',
            'topbar_right_url' => 'nullable|url|max:255',
            'topbar_marquee_text' => 'nullable|string|max:255',
            'topbar_marquee_url' => 'nullable|url|max:255',
            'header_menu_enabled' => 'nullable|boolean',
            'header_search_enabled' => 'nullable|boolean',
            'header_presentation_enabled' => 'nullable|boolean',
            'header_presentation_text' => 'nullable|string|max:100',
            'header_cta_enabled' => 'nullable|boolean',
            'header_cta_text' => 'nullable|string|max:100',
            'header_cta_url' => 'nullable|string|max:255',
            'footer_enabled' => 'nullable|boolean',
            'footer_about_enabled' => 'nullable|boolean',
            'footer_social_enabled' => 'nullable|boolean',
            'footer_newsletter_enabled' => 'nullable|boolean',
            'footer_newsletter_label' => 'nullable|string|max:255',
            'footer_services_enabled' => 'nullable|boolean',
            'footer_services_title' => 'nullable|string|max:100',
            'footer_company_enabled' => 'nullable|boolean',
            'footer_company_title' => 'nullable|string|max:100',
            'footer_legal_enabled' => 'nullable|boolean',
            'footer_legal_title' => 'nullable|string|max:100',
            'footer_contact_enabled' => 'nullable|boolean',
            'footer_contact_title' => 'nullable|string|max:100',
            'footer_presentation_link_enabled' => 'nullable|boolean',
            'footer_copyright_text' => 'nullable|string|max:255',
            'contact_india_title' => 'nullable|string|max:255',
            'contact_india_city' => 'nullable|string|max:255',
            'contact_india_address' => 'nullable|string|max:600',
            'contact_india_directions_url' => 'nullable|url|max:255',
            'contact_india_image' => 'nullable|image|max:5120',
            'contact_aus_title' => 'nullable|string|max:255',
            'contact_aus_city' => 'nullable|string|max:255',
            'contact_aus_address' => 'nullable|string|max:600',
            'contact_aus_directions_url' => 'nullable|url|max:255',
            'contact_aus_image' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['_token', '_method']);
        $groupMap = [
            'topbar_enabled' => 'header',
            'top_scroller_speed' => 'header',
            'topbar_left_text' => 'header',
            'topbar_right_text' => 'header',
            'topbar_right_url' => 'header',
            'topbar_marquee_text' => 'header',
            'topbar_marquee_url' => 'header',
            'header_menu_enabled' => 'header',
            'header_search_enabled' => 'header',
            'header_presentation_enabled' => 'header',
            'header_presentation_text' => 'header',
            'header_cta_enabled' => 'header',
            'header_cta_text' => 'header',
            'header_cta_url' => 'header',
            'footer_enabled' => 'footer',
            'footer_about_enabled' => 'footer',
            'footer_about' => 'footer',
            'footer_social_enabled' => 'footer',
            'footer_newsletter_enabled' => 'footer',
            'footer_newsletter_label' => 'footer',
            'footer_services_enabled' => 'footer',
            'footer_services_title' => 'footer',
            'footer_company_enabled' => 'footer',
            'footer_company_title' => 'footer',
            'footer_legal_enabled' => 'footer',
            'footer_legal_title' => 'footer',
            'footer_contact_enabled' => 'footer',
            'footer_contact_title' => 'footer',
            'footer_presentation_link_enabled' => 'footer',
            'footer_copyright_text' => 'footer',
        ];

        $groupOverrides = [
            'site_name' => 'general',
            'site_tagline' => 'general',
            'site_description' => 'general',
            'site_logo' => 'general',
            'site_favicon' => 'general',
            'contact_email' => 'contact',
            'contact_phone' => 'contact',
            'contact_phone2' => 'contact',
            'whatsapp_number' => 'contact',
            'contact_address' => 'contact',
            'business_hours' => 'contact',
            'contact_india_title' => 'contact',
            'contact_india_city' => 'contact',
            'contact_india_address' => 'contact',
            'contact_india_directions_url' => 'contact',
            'contact_india_image' => 'contact',
            'contact_aus_title' => 'contact',
            'contact_aus_city' => 'contact',
            'contact_aus_address' => 'contact',
            'contact_aus_directions_url' => 'contact',
            'contact_aus_image' => 'contact',
            'meta_title_suffix' => 'seo',
            'analytics_code' => 'seo',
            'recaptcha_site_key' => 'seo',
            'recaptcha_secret_key' => 'seo',
            'social_facebook' => 'social',
            'social_twitter' => 'social',
            'social_linkedin' => 'social',
            'social_instagram' => 'social',
            'social_youtube' => 'social',
            'social_github' => 'social',
        ];

        $contentPrefixes = [
            'home_',
            'about_',
            'services_',
            'contact_',
            'blog_',
            'events_',
            'event_',
            'gallery_',
            'testimonials_',
            'faqs_',
            'portfolio_',
            'careers_',
            'terms_',
            'privacy_',
        ];

        $companyCode = env('COMPANY_CODE', 'SITE');
        $academicYear = date('Y');
        $paths = config('dospaces.paths', []);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $originalName = $file->getClientOriginalName();
                $safeFileName = $this->storageService->generateSafeFilename($originalName, $companyCode);
                $type = array_key_exists($key, $paths) ? $key : $key;

                $uploadResult = $this->storageService->uploadFile(
                    $companyCode,
                    $academicYear,
                    $type,
                    $file->getRealPath(),
                    $safeFileName,
                    'public-read'
                );

                if (!$uploadResult['success']) {
                    return back()->withErrors(['upload' => $uploadResult['message'] ?? 'File upload failed.']);
                }

                $payload = ['value' => $uploadResult['url']];
                if (isset($groupMap[$key])) {
                    $payload['group'] = $groupMap[$key];
                } elseif (isset($groupOverrides[$key])) {
                    $payload['group'] = $groupOverrides[$key];
                } else {
                    foreach ($contentPrefixes as $prefix) {
                        if (str_starts_with($key, $prefix)) {
                            $payload['group'] = 'content';
                            break;
                        }
                    }
                }
                if (!isset($payload['group'])) {
                    $payload['group'] = 'general';
                }
                Setting::updateOrCreate(['key' => $key], $payload);
            } else {
                $payload = ['value' => is_array($value) ? json_encode($value) : $value];
                if (isset($groupMap[$key])) {
                    $payload['group'] = $groupMap[$key];
                } elseif (isset($groupOverrides[$key])) {
                    $payload['group'] = $groupOverrides[$key];
                } else {
                    foreach ($contentPrefixes as $prefix) {
                        if (str_starts_with($key, $prefix)) {
                            $payload['group'] = 'content';
                            break;
                        }
                    }
                }
                if (!isset($payload['group'])) {
                    $payload['group'] = 'general';
                }
                Setting::updateOrCreate(['key' => $key], $payload);
            }
        }

        if (function_exists('clear_settings_cache')) {
            clear_settings_cache();
        } else {
            \Illuminate\Support\Facades\Cache::forget('settings.all');
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
