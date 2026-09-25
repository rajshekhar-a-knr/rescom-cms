<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\Faq;
use App\Models\NewsletterSubscriber;
use App\Models\ActivityLog;
use App\Models\PageVisit;
use Illuminate\Support\Carbon;
use App\Models\GalleryItem;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'contacts'         => Contact::count(),
            'new_contacts'     => Contact::where('status', 'new')->count(),
            'projects'         => Portfolio::where('is_active', 1)->count(),
            'blogs'            => BlogPost::where('status', 'published')->count(),
            'draft_blogs'      => BlogPost::where('status', 'draft')->count(),
            'applications'     => JobApplication::count(),
            'new_applications' => JobApplication::where('status', 'pending')->count(),
            'subscribers'      => NewsletterSubscriber::where('status', 'active')->count(),
            'services'         => Service::where('is_active', 1)->count(),
            'team'             => TeamMember::where('is_active', 1)->count(),
            'testimonials'     => Testimonial::where('is_active', 1)->count(),
            'clients'          => Client::where('is_active', 1)->count(),
            'faqs'             => Faq::where('is_active', 1)->count(),
            'gallery'          => GalleryItem::where('is_active', 1)->count(),
            'events'           => Event::where('is_active', 1)->count(),
            'website_visits'   => PageVisit::count(),
            'website_visits_today' => PageVisit::whereDate('visited_at', Carbon::today())->count(),
        ];

        $recentContacts     = Contact::orderBy('created_at', 'desc')->take(8)->get();
        $recentBlogs        = BlogPost::orderBy('created_at', 'desc')->take(6)->get();
        $recentApplications = JobApplication::with('job')->where('status', 'pending')->orderBy('created_at', 'desc')->take(5)->get();
        $recentEvents = Event::where('is_active', 1)->orderBy('event_date', 'desc')->take(5)->get();
        $recentGallery = GalleryItem::where('is_active', 1)->orderBy('created_at', 'desc')->take(6)->get();

        return view('admin.pages.dashboard.index', compact('stats', 'recentContacts', 'recentBlogs', 'recentApplications', 'recentEvents', 'recentGallery'));
    }

    public function newsletter()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->paginate(50);
        $latestId = NewsletterSubscriber::max('id') ?? 0;
        request()->session()->put('newsletter_last_seen_id', $latestId);
        \Illuminate\Support\Facades\Cache::forever('newsletter_last_seen_id_' . auth()->id(), $latestId);
        return view('admin.pages.newsletter.index', compact('subscribers'));
    }

    public function exportNewsletter()
    {
        $subscribers = NewsletterSubscriber::where('status', 'active')->get();
        $csv = "Name,Email,Subscribed At\n";
        foreach ($subscribers as $s) {
            $csv .= "\"{$s->name}\",\"{$s->email}\",\"{$s->created_at}\"\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="newsletter_subscribers_' . date('Y-m-d') . '.csv"',
        ]);
    }

    public function activityLogs()
    {
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.pages.activity-logs.index', compact('logs'));
    }

    public function websiteVisits()
    {
        $preset = request('preset', '');
        $startDate = request('start_date');
        $endDate = request('end_date');
        $selectedCountry = request('country');
        $selectedState = request('state');
        $selectedCity = request('city');
        $selectedDevice = request('device_type');
        $selectedPath = request('path');
        $search = request('search');

        // Preset handling
        $now = Carbon::now();
        if ($preset === 'today') {
            $startDate = $now->copy()->startOfDay()->toDateString();
            $endDate = $now->copy()->endOfDay()->toDateString();
        } elseif ($preset === 'yesterday') {
            $startDate = $now->copy()->subDay()->startOfDay()->toDateString();
            $endDate = $now->copy()->subDay()->endOfDay()->toDateString();
        } elseif ($preset === '24h') {
            $startDate = $now->copy()->subHours(24)->toDateTimeString();
            $endDate = $now->copy()->toDateTimeString();
        } elseif ($preset === '7d') {
            $startDate = $now->copy()->subDays(7)->toDateString();
            $endDate = $now->copy()->toDateString();
        } elseif ($preset === '30d') {
            $startDate = $now->copy()->subDays(30)->toDateString();
            $endDate = $now->copy()->toDateString();
        } elseif ($preset === 'this_month') {
            $startDate = $now->copy()->startOfMonth()->toDateString();
            $endDate = $now->copy()->endOfMonth()->toDateString();
        }

        // Base Query
        $baseQuery = PageVisit::query();

        if ($startDate && $endDate) {
            if ($preset === '24h') {
                $baseQuery->whereBetween('visited_at', [$startDate, $endDate]);
            } else {
                $baseQuery->whereDate('visited_at', '>=', $startDate)
                          ->whereDate('visited_at', '<=', $endDate);
            }
        } elseif ($startDate) {
            $baseQuery->whereDate('visited_at', '>=', $startDate);
        } elseif ($endDate) {
            $baseQuery->whereDate('visited_at', '<=', $endDate);
        }

        if ($selectedCountry) {
            $baseQuery->where('country', $selectedCountry);
        }
        if ($selectedState) {
            $baseQuery->where('state', $selectedState);
        }
        if ($selectedCity) {
            $baseQuery->where(function($q) use ($selectedCity) {
                $q->where('city', $selectedCity)
                  ->orWhere('district', $selectedCity);
            });
        }
        if ($selectedDevice) {
            $baseQuery->where('device_type', $selectedDevice);
        }
        if ($selectedPath) {
            $baseQuery->where('path', $selectedPath);
        }
        if ($search) {
            $baseQuery->where(function($q) use ($search) {
                $q->where('path', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('ip', 'like', "%{$search}%")
                  ->orWhere('referrer', 'like', "%{$search}%");
            });
        }

        // High Level Metrics
        $totalVisits = (clone $baseQuery)->count();
        $uniqueVisitors = (clone $baseQuery)->distinct('ip')->count('ip');
        
        $todayVisits = PageVisit::whereDate('visited_at', Carbon::today())->count();
        $yesterdayVisits = PageVisit::whereDate('visited_at', Carbon::yesterday())->count();
        $growth = $yesterdayVisits > 0 ? round((($todayVisits - $yesterdayVisits) / $yesterdayVisits) * 100, 1) : null;
        $activeNowEstimate = PageVisit::where('visited_at', '>=', Carbon::now()->subMinutes(15))->count();

        // 1. STATE-WISE BREAKDOWN (Rich geographic analytics)
        $stateBreakdown = (clone $baseQuery)
            ->selectRaw("
                coalesce(nullif(state,''), 'Unknown State') as state_name,
                country,
                count(*) as total,
                count(distinct ip) as unique_ips
            ")
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->groupBy('state_name', 'country')
            ->orderByDesc('total')
            ->limit(35)
            ->get()
            ->map(function ($row) use ($totalVisits) {
                $row->share_pct = $totalVisits > 0 ? round(($row->total / $totalVisits) * 100, 1) : 0;
                return $row;
            });

        // 2. DISTRICT / CITY / PLACE BREAKDOWN (Granular place intelligence)
        $cityDistrictBreakdown = (clone $baseQuery)
            ->selectRaw("
                coalesce(nullif(district,''), nullif(city,''), 'Unknown Place') as place_name,
                city,
                state,
                country,
                avg(latitude) as lat,
                avg(longitude) as lon,
                count(*) as total,
                count(distinct ip) as unique_ips
            ")
            ->where(function($q) {
                $q->whereNotNull('city')->where('city', '!=', '')
                  ->orWhereNotNull('district')->where('district', '!=', '');
            })
            ->groupBy('place_name', 'city', 'state', 'country')
            ->orderByDesc('total')
            ->limit(50)
            ->get()
            ->map(function ($row) use ($totalVisits) {
                $row->share_pct = $totalVisits > 0 ? round(($row->total / $totalVisits) * 100, 1) : 0;
                return $row;
            });

        // 3. COUNTRY BREAKDOWN
        $countryBreakdown = (clone $baseQuery)
            ->selectRaw("country, count(*) as total, count(distinct ip) as unique_ips")
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(20)
            ->get()
            ->map(function ($row) use ($totalVisits) {
                $row->share_pct = $totalVisits > 0 ? round(($row->total / $totalVisits) * 100, 1) : 0;
                return $row;
            });

        // 4. TIMELINE WAVE (Hourly vs Daily adaptively)
        $isHourly = (!$startDate && !$endDate) || $preset === '24h' || $preset === 'today' || $preset === 'yesterday';
        if ($isHourly) {
            $timelineStart = Carbon::now()->subHours(23)->startOfHour();
            $rawVisits = (clone $baseQuery)
                ->where('visited_at', '>=', $timelineStart)
                ->selectRaw("date_format(visited_at, '%H:00') as time_label, count(*) as total, count(distinct ip) as unique_count")
                ->groupBy('time_label')
                ->pluck('total', 'time_label');

            $timelineLabels = [];
            $timelineCounts = [];
            for ($i = 0; $i < 24; $i++) {
                $label = $timelineStart->copy()->addHours($i)->format('H:00');
                $timelineLabels[] = $label;
                $timelineCounts[] = $rawVisits[$label] ?? 0;
            }
        } else {
            $daysDiff = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) ?: 7;
            $daysDiff = min($daysDiff, 60);
            $timelineStart = Carbon::parse($startDate)->startOfDay();

            $rawVisits = (clone $baseQuery)
                ->selectRaw("date_format(visited_at, '%b %d') as date_label, count(*) as total")
                ->groupBy('date_label')
                ->pluck('total', 'date_label');

            $timelineLabels = [];
            $timelineCounts = [];
            for ($i = 0; $i <= $daysDiff; $i++) {
                $label = $timelineStart->copy()->addDays($i)->format('M d');
                $timelineLabels[] = $label;
                $timelineCounts[] = $rawVisits[$label] ?? 0;
            }
        }

        // 5. TOP PAGES
        $topPages = (clone $baseQuery)
            ->selectRaw('path, count(*) as total, count(distinct ip) as unique_ips')
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(12)
            ->get()
            ->map(function ($row) use ($totalVisits) {
                $row->share_pct = $totalVisits > 0 ? round(($row->total / $totalVisits) * 100, 1) : 0;
                return $row;
            });

        // 6. TOP REFERRERS
        $topReferrers = (clone $baseQuery)
            ->selectRaw('referrer, count(*) as total')
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->groupBy('referrer')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        // 7. DEVICE & HARDWARE BREAKDOWN
        $deviceBreakdown = (clone $baseQuery)
            ->selectRaw("coalesce(device_type, 'desktop') as device, count(*) as total")
            ->groupBy('device')
            ->pluck('total', 'device')
            ->toArray();

        // 8. BROWSER & OS TELEMETRY
        $sampleVisitsForUa = (clone $baseQuery)
            ->select('user_agent')
            ->whereNotNull('user_agent')
            ->orderByDesc('id')
            ->limit(600)
            ->get();
        $uaTelemetry = $this->parseUserAgentBreakdown($sampleVisitsForUa);

        // 9. MAP COORDINATES (For Leaflet interactive cyber radar map)
        $geoMapPoints = (clone $baseQuery)
            ->selectRaw("
                city,
                state,
                country,
                latitude as lat,
                longitude as lng,
                count(*) as total
            ")
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0)
            ->groupBy('city', 'state', 'country', 'latitude', 'longitude')
            ->orderByDesc('total')
            ->limit(150)
            ->get();

        // 10. RECENT VISITS STREAM (Latest live events)
        $recentVisits = (clone $baseQuery)
            ->select('id', 'path', 'full_url', 'ip', 'country', 'state', 'city', 'district', 'device_type', 'user_agent', 'referrer', 'visited_at')
            ->orderByDesc('visited_at')
            ->limit(30)
            ->get();

        // 11. DYNAMIC CASCADING GEO HIERARCHY
        $geoHierarchy = $this->getGeoHierarchy();
        $availableCountries = array_keys($geoHierarchy);

        if ($selectedCountry && isset($geoHierarchy[$selectedCountry])) {
            $availableStates = array_keys($geoHierarchy[$selectedCountry]);
        } else {
            $allStates = [];
            foreach ($geoHierarchy as $cStates) {
                foreach (array_keys($cStates) as $s) {
                    $allStates[$s] = true;
                }
            }
            $availableStates = array_keys($allStates);
            sort($availableStates);
        }

        if ($selectedCountry && $selectedState && isset($geoHierarchy[$selectedCountry][$selectedState])) {
            $availablePlaces = $geoHierarchy[$selectedCountry][$selectedState];
        } elseif ($selectedState) {
            $places = [];
            foreach ($geoHierarchy as $cName => $cStates) {
                if (isset($cStates[$selectedState])) {
                    $places = array_merge($places, $cStates[$selectedState]);
                }
            }
            $availablePlaces = array_values(array_unique($places));
            sort($availablePlaces);
        } elseif ($selectedCountry && isset($geoHierarchy[$selectedCountry])) {
            $places = [];
            foreach ($geoHierarchy[$selectedCountry] as $sPlaces) {
                $places = array_merge($places, $sPlaces);
            }
            $availablePlaces = array_values(array_unique($places));
            sort($availablePlaces);
        } else {
            $availablePlaces = [];
        }

        // Ajax / JSON response
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'totalVisits' => $totalVisits,
                'uniqueVisitors' => $uniqueVisitors,
                'todayVisits' => $todayVisits,
                'activeNowEstimate' => $activeNowEstimate,
                'growth' => $growth,
                'timelineLabels' => $timelineLabels,
                'timelineCounts' => $timelineCounts,
                'stateBreakdown' => $stateBreakdown,
                'cityDistrictBreakdown' => $cityDistrictBreakdown,
                'countryBreakdown' => $countryBreakdown,
                'geoMapPoints' => $geoMapPoints,
                'recentVisits' => $recentVisits,
                'geoHierarchy' => $geoHierarchy,
            ]);
        }

        return view('admin.pages.website-visits.index', [
            'totalVisits' => $totalVisits,
            'uniqueVisitors' => $uniqueVisitors,
            'todayVisits' => $todayVisits,
            'yesterdayVisits' => $yesterdayVisits,
            'growth' => $growth,
            'activeNowEstimate' => $activeNowEstimate,
            'stateBreakdown' => $stateBreakdown,
            'cityDistrictBreakdown' => $cityDistrictBreakdown,
            'countryBreakdown' => $countryBreakdown,
            'timelineLabels' => $timelineLabels,
            'timelineCounts' => $timelineCounts,
            'isHourly' => $isHourly,
            'topPages' => $topPages,
            'topReferrers' => $topReferrers,
            'deviceBreakdown' => $deviceBreakdown,
            'browserBreakdown' => $uaTelemetry['browsers'],
            'osBreakdown' => $uaTelemetry['os'],
            'geoMapPoints' => $geoMapPoints,
            'recentVisits' => $recentVisits,
            'availableCountries' => $availableCountries,
            'availableStates' => $availableStates,
            'availablePlaces' => $availablePlaces,
            'geoHierarchy' => $geoHierarchy,
            'preset' => $preset,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'selectedCountry' => $selectedCountry,
            'selectedState' => $selectedState,
            'selectedCity' => $selectedCity,
            'selectedDevice' => $selectedDevice,
            'selectedPath' => $selectedPath,
            'search' => $search,
        ]);
    }

    public function websiteVisitsStream()
    {
        $recent = PageVisit::select('id', 'path', 'ip', 'country', 'state', 'city', 'district', 'device_type', 'visited_at')
            ->orderByDesc('visited_at')
            ->limit(15)
            ->get()
            ->map(function ($v) {
                $locationParts = array_filter([$v->city ?: $v->district, $v->state, $v->country]);
                $location = !empty($locationParts) ? implode(', ', $locationParts) : 'Local / Unknown';
                
                // Mask IP for privacy and telemetry style
                $ipParts = explode('.', $v->ip);
                $maskedIp = count($ipParts) === 4 
                    ? $ipParts[0] . '.' . $ipParts[1] . '.***.***'
                    : (strlen($v->ip) > 6 ? substr($v->ip, 0, 4) . '***' : $v->ip);

                return [
                    'id' => $v->id,
                    'path' => $v->path,
                    'masked_ip' => $maskedIp,
                    'location' => $location,
                    'device' => strtolower($v->device_type ?: 'desktop'),
                    'time_ago' => $v->visited_at ? $v->visited_at->diffForHumans(null, true) . ' ago' : 'now',
                    'timestamp' => $v->visited_at ? $v->visited_at->format('H:i:s') : '',
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $recent,
            'active_now' => PageVisit::where('visited_at', '>=', Carbon::now()->subMinutes(15))->count(),
            'today_total' => PageVisit::whereDate('visited_at', Carbon::today())->count(),
        ]);
    }

    public function exportWebsiteVisits()
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        $selectedCountry = request('country');
        $selectedState = request('state');
        $selectedCity = request('city');
        $selectedDevice = request('device_type');

        $query = PageVisit::query();

        if ($startDate && $endDate) {
            $query->whereDate('visited_at', '>=', $startDate)->whereDate('visited_at', '<=', $endDate);
        } elseif ($startDate) {
            $query->whereDate('visited_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('visited_at', '<=', $endDate);
        }

        if ($selectedCountry) $query->where('country', $selectedCountry);
        if ($selectedState) $query->where('state', $selectedState);
        if ($selectedCity) {
            $query->where(function($q) use ($selectedCity) {
                $q->where('city', $selectedCity)->orWhere('district', $selectedCity);
            });
        }
        if ($selectedDevice) $query->where('device_type', $selectedDevice);

        $visits = $query->orderByDesc('visited_at')->limit(10000)->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="website_telemetry_visits_' . date('Y-m-d_His') . '.csv"',
        ];

        $callback = function () use ($visits) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8 Excel support
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, ['ID', 'Date & Time (IST)', 'Page Path', 'Country', 'State/Province', 'City/District', 'Latitude', 'Longitude', 'Device Type', 'IP Address', 'Referrer', 'User Agent']);

            foreach ($visits as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->visited_at ? $row->visited_at->format('Y-m-d H:i:s') : '',
                    $row->path,
                    $row->country ?? '',
                    $row->state ?? '',
                    $row->district ?: ($row->city ?? ''),
                    $row->latitude ?? '',
                    $row->longitude ?? '',
                    $row->device_type ?? '',
                    $row->ip ?? '',
                    $row->referrer ?? '',
                    $row->user_agent ?? '',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function parseUserAgentBreakdown($visits)
    {
        $browsers = ['Chrome' => 0, 'Safari' => 0, 'Firefox' => 0, 'Edge' => 0, 'Opera' => 0, 'Other' => 0];
        $osList = ['Windows' => 0, 'Android' => 0, 'iOS' => 0, 'macOS' => 0, 'Linux' => 0, 'Other' => 0];

        foreach ($visits as $v) {
            $ua = $v->user_agent ?? '';
            if (!$ua) {
                $browsers['Other']++;
                $osList['Other']++;
                continue;
            }

            // Browser
            if (stripos($ua, 'Edg') !== false) {
                $browsers['Edge']++;
            } elseif (stripos($ua, 'Opera') !== false || stripos($ua, 'OPR') !== false) {
                $browsers['Opera']++;
            } elseif (stripos($ua, 'Chrome') !== false || stripos($ua, 'CriOS') !== false) {
                $browsers['Chrome']++;
            } elseif (stripos($ua, 'Safari') !== false && stripos($ua, 'Chrome') === false) {
                $browsers['Safari']++;
            } elseif (stripos($ua, 'Firefox') !== false || stripos($ua, 'FxiOS') !== false) {
                $browsers['Firefox']++;
            } else {
                $browsers['Other']++;
            }

            // OS
            if (stripos($ua, 'Windows') !== false) {
                $osList['Windows']++;
            } elseif (stripos($ua, 'Android') !== false) {
                $osList['Android']++;
            } elseif (stripos($ua, 'iPhone') !== false || stripos($ua, 'iPad') !== false || stripos($ua, 'iPod') !== false) {
                $osList['iOS']++;
            } elseif (stripos($ua, 'Mac OS') !== false || stripos($ua, 'Macintosh') !== false) {
                $osList['macOS']++;
            } elseif (stripos($ua, 'Linux') !== false) {
                $osList['Linux']++;
            } else {
                $osList['Other']++;
            }
        }

        return [
            'browsers' => array_filter($browsers),
            'os' => array_filter($osList)
        ];
    }

    private function getGeoHierarchy()
    {
        return \Illuminate\Support\Facades\Cache::remember('geo_hierarchy_v3', now()->addHours(6), function () {
            $rawLocations = PageVisit::select('country', 'state', 'city', 'district')
                ->whereNotNull('country')
                ->where('country', '!=', '')
                ->whereNotNull('state')
                ->where('state', '!=', '')
                ->groupBy('country', 'state', 'city', 'district')
                ->get();

            $geoHierarchy = [];
            foreach ($rawLocations as $loc) {
                $c = trim($loc->country);
                $s = trim($loc->state);
                $p = trim($loc->district ?: $loc->city);

                if (!$c || !$s) continue;

                if (!isset($geoHierarchy[$c])) {
                    $geoHierarchy[$c] = [];
                }
                if (!isset($geoHierarchy[$c][$s])) {
                    $geoHierarchy[$c][$s] = [];
                }
                if ($p && !in_array($p, $geoHierarchy[$c][$s])) {
                    $geoHierarchy[$c][$s][] = $p;
                }
            }

            // Standard Karnataka districts
            $karnatakaDistricts = [
                'Bagalkote', 'Ballari', 'Belagavi', 'Bengaluru', 'Bengaluru Rural', 'Bidar', 
                'Chamarajanagar', 'Chikkaballapura', 'Chikkamagaluru', 'Chitradurga', 'Davanagere', 
                'Dharwad', 'Gadag', 'Gubbi', 'Hassan', 'Haveri', 'Hubballi', 'Kalaburagi', 
                'Kodagu', 'Kolar', 'Koppal', 'Mandya', 'Mangaluru', 'Mysuru', 'Raichur', 
                'Ramanagara', 'Shivamogga', 'Sāgar', 'Tumakuru', 'Udupi', 'Uttara Kannada', 
                'Vijayanagara', 'Vijayapura', 'Yadgir'
            ];

            // Standard Indian States if not in DB
            $standardIndianStates = [
                'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 
                'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 
                'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 
                'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 
                'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 
                'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir', 
                'Ladakh', 'Lakshadweep', 'Puducherry'
            ];

            if (!isset($geoHierarchy['India'])) {
                $geoHierarchy['India'] = [];
            }

            foreach ($standardIndianStates as $st) {
                if (!isset($geoHierarchy['India'][$st])) {
                    $geoHierarchy['India'][$st] = [];
                }
            }

            $geoHierarchy['India']['Karnataka'] = array_values(array_unique(array_merge($geoHierarchy['India']['Karnataka'], $karnatakaDistricts)));
            sort($geoHierarchy['India']['Karnataka']);

            // Sort all states & places
            foreach ($geoHierarchy as $country => &$states) {
                ksort($states);
                foreach ($states as $state => &$places) {
                    sort($places);
                }
            }
            ksort($geoHierarchy);

            return $geoHierarchy;
        });
    }
}
