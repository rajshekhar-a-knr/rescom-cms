@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<span>></span> <span class="current">Dashboard</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ auth()->user()->name }}! Here's what's happening.</p>
    </div>
    <div style="display:flex;gap:10px">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="fas fa-envelope"></i> View Inquiries
        </a>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Blog Post
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    
    <a href="{{ route('admin.website-visits') }}" class="stat-card">
        
        <div class="stat-icon" style="background:#f0fdfa">
            <i class="fas fa-chart-line" style="color:#0891b2"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['website_visits'] }}</span>
            <span class="stat-label">Website Visits</span>
            <div class="stat-change stat-up"><i class="fas fa-arrow-up"></i> {{ $stats['website_visits_today'] }} today</div>
        </div>
    </a>

    <a href="{{ route('admin.contacts.index') }}" class="stat-card">
        <div class="stat-icon" style="background:#eff6ff">
            <i class="fas fa-envelope" style="color:#3b82f6"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['contacts'] }}</span>
            <span class="stat-label">Total Inquiries</span>
            <div class="stat-change stat-up"><i class="fas fa-arrow-up"></i> {{ $stats['new_contacts'] }} new today</div>
        </div>
    </a>

    <a href="{{ route('admin.portfolio.index') }}" class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4">
            <i class="fas fa-briefcase" style="color:#10b981"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['projects'] }}</span>
            <span class="stat-label">Products Projects</span>
            <div class="stat-change stat-up"><i class="fas fa-arrow-up"></i> Growing Products</div>
        </div>
    </a>

    <a href="{{ route('admin.blog.index') }}" class="stat-card">
        <div class="stat-icon" style="background:#faf5ff">
            <i class="fas fa-newspaper" style="color:#8b5cf6"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['blogs'] }}</span>
            <span class="stat-label">Blog Posts</span>
            <div class="stat-change" style="color:#8b5cf6"><i class="fas fa-file-alt"></i> {{ $stats['draft_blogs'] }} drafts</div>
        </div>
    </a>

    <a href="{{ route('admin.jobs.applications') }}" class="stat-card">
        <div class="stat-icon" style="background:#fefce8">
            <i class="fas fa-user-tie" style="color:#f59e0b"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['applications'] }}</span>
            <span class="stat-label">Job Applications</span>
            <div class="stat-change stat-up"><i class="fas fa-user-plus"></i> {{ $stats['new_applications'] }} pending</div>
        </div>
    </a>

    <a href="{{ route('admin.newsletter') }}" class="stat-card">
        <div class="stat-icon" style="background:#fef2f2">
            <i class="fas fa-at" style="color:#ef4444"></i>
        </div>
        <div>
            <span class="stat-value">{{ $stats['subscribers'] }}</span>
            <span class="stat-label">Subscribers</span>
            <div class="stat-change stat-up"><i class="fas fa-arrow-up"></i> Active subscribers</div>
        </div>
    </a>

</div>

<!-- Admin Modules -->
<div class="card" style="margin-top:0">
    <div class="card-header">
        <h3 class="card-title">Admin Modules</h3>
    </div>
    <div class="card-body quick-actions">
        @foreach([
            'Content Management' => [
                ['admin.banners.index','fas fa-images','Hero Banners','#3b82f6'],
                ['admin.services.index','fas fa-cogs','Services','#10b981'],
                ['admin.portfolio.index','fas fa-briefcase','Products','#8b5cf6'],
                ['admin.demo-products.index','fas fa-key','Demo Products','#0ea5e9'],
                ['admin.pages.index','fas fa-file-alt','Pages','#f59e0b'],
                ['admin.about.index','fas fa-building-user','About Page','#f97316'],
                ['admin.legal-pages.index','fas fa-scale-balanced','Legal Pages','#6366f1'],
                ['admin.gallery.index','fas fa-camera-retro','Gallery','#2563eb'],
            ],
            'Blog' => [
                ['admin.blog.index','fas fa-newspaper','Blog Posts','#2563eb'],
                ['admin.blog.create','fas fa-plus','New Blog Post','#3b82f6'],
            ],
            'Team & Social Proof' => [
                ['admin.team.index','fas fa-users','Team Members','#8b5cf6'],
                ['admin.interns.index','fas fa-user-graduate','Interns','#14b8a6'],
                ['admin.testimonials.index','fas fa-quote-left','Testimonials','#f59e0b'],
                ['admin.clients.index','fas fa-building','Clients / Partners','#10b981'],
                ['admin.stats.index','fas fa-chart-bar','Stats & Counters','#0ea5a4'],
                ['admin.events.index','fas fa-calendar-check','Events','#f97316'],
            ],
            'Leads & HR' => [
                ['admin.contacts.index','fas fa-envelope','Inquiries','#3b82f6'],
                ['admin.jobs.index','fas fa-briefcase','Job Listings','#f59e0b'],
                ['admin.career-benefits.index','fas fa-star','Career Benefits','#ec4899'],
                ['admin.jobs.applications','fas fa-user-tie','Applications','#ef4444'],
                ['admin.newsletter','fas fa-at','Newsletter','#0ea5a4'],
            ],
            'Other' => [
                ['admin.chatbot.index','fas fa-robot','Chatbot','#8b5cf6'],
                ['admin.faqs.index','fas fa-question-circle','FAQs','#6366f1'],
                ['admin.technologies.index','fas fa-microchip','Technologies','#14b8a6'],
                ['admin.media.index','fas fa-photo-video','Media Library','#0891b2'],
            ],
            'System' => [
                ['admin.settings.index','fas fa-sliders-h','Settings','#6b7280'],
                ['admin.permissions.index','fas fa-user-lock','User Rights','#334155'],
                ['admin.users.index','fas fa-user-shield','Admin Users','#0f172a'],
                ['admin.activity-logs','fas fa-history','Activity Logs','#64748b'],
                ['admin.website-visits','fas fa-chart-line','Website Visits','#2563eb'],
                ['home','fas fa-external-link-alt','View Website','#0f172a'],
            ],
        ] as $section => $items)
            <div style="grid-column:1 / -1;font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;margin-top:4px">
                {{ $section }}
            </div>
            @foreach($items as [$route, $icon, $label, $color])
            <a href="{{ route($route) }}" class="quick-card">
                <div class="quick-icon" style="background:{{ $color }}1a;color:{{ $color }}">
                    <i class="{{ $icon }}"></i>
                </div>
                <div>
                    <div style="font-weight:600">{{ $label }}</div>
                    <div class="quick-meta">Quick access</div>
                </div>
            </a>
            @endforeach
        @endforeach
    </div>
</div>
<!-- Recent Inquiries (Full Width) -->
<div class="card" style="margin-top:20px">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-envelope" style="color:#3b82f6"></i> Recent Inquiries</h3>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentContacts as $contact)
                <tr>
                    <td>
                        <div style="font-weight:600">{{ $contact->name }}</div>
                        <div style="font-size:12px;color:#94a3b8">{{ $contact->company }}</div>
                    </td>
                    <td style="font-size:13px">{{ $contact->email }}</td>
                    <td style="font-size:13px">{{ Str::limit($contact->subject, 35) }}</td>
                    <td>
                        @php $colors = ['new'=>'blue','read'=>'yellow','replied'=>'green','spam'=>'red','archived'=>'gray']; @endphp
                        <span class="badge badge-{{ $colors[$contact->status] ?? 'gray' }}">{{ ucfirst($contact->status) }}</span>
                    </td>
                    <td style="font-size:12px;color:#94a3b8">{{ $contact->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Overview + Recent Blogs -->
<div class="dashboard-row" style="margin-top:20px">

    <!-- Site Overview -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-server" style="color:#10b981"></i> Site Overview</h3>
        </div>
        <div class="card-body">
            @foreach([
                ['fa-globe','Active Services',$stats['services'],'#3b82f6'],
                ['fa-briefcase','Portfolio Projects',$stats['projects'],'#10b981'],
                ['fa-users','Team Members',$stats['team'],'#8b5cf6'],
                ['fa-star','Testimonials',$stats['testimonials'],'#f59e0b'],
                ['fa-building','Clients',$stats['clients'],'#ef4444'],
                ['fa-question-circle','FAQs',$stats['faqs'],'#0891b2'],
                ['fa-camera-retro','Gallery Images',$stats['gallery'],'#2563eb'],
                ['fa-calendar-check','Events',$stats['events'],'#f97316'],
            ] as [$icon, $label, $value, $color])
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9">
                <div style="display:flex;align-items:center;gap:10px">
                    <div style="width:30px;height:30px;background:{{ $color }}1a;border-radius:7px;display:flex;align-items:center;justify-content:center">
                        <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:13px"></i>
                    </div>
                    <span style="font-size:13.5px;color:#475569">{{ $label }}</span>
                </div>
                <span style="font-size:18px;font-weight:800;color:var(--text)">{{ $value }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Blog Posts -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-newspaper" style="color:#8b5cf6"></i> Recent Blog Posts</h3>
            <!-- <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New</a> -->
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBlogs as $post)
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:13px">{{ Str::limit($post->title, 40) }}</div>
                            <div style="font-size:11px;color:#94a3b8">{{ $post->published_at?->format('M d, Y') }}</div>
                        </td>
                        <td>
                            <span class="badge {{ $post->status === 'published' ? 'badge-green' : 'badge-yellow' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td style="font-size:13px;color:#64748b">{{ number_format($post->views) }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="dashboard-row" style="margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-camera-retro" style="color:#2563eb"></i> Latest Gallery Uploads</h3>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:12px">
                @foreach($recentGallery as $item)
                    <div style="border-radius:10px;overflow:hidden;border:1px solid #e2e8f0">
                        <img src="{{ media_url($item->image) }}" alt="Gallery" style="width:100%;height:90px;object-fit:cover;display:block">
                    </div>
                @endforeach
                @if($recentGallery->isEmpty())
                    <div style="grid-column:1/-1;color:#94a3b8">No gallery uploads yet.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-calendar-check" style="color:#f97316"></i> Upcoming Events</h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentEvents as $event)
                    <tr>
                        <td style="font-weight:600">{{ Str::limit($event->title, 40) }}</td>
                        <td style="font-size:13px;color:#64748b">{{ $event->event_date ? $event->event_date->format('M d, Y') : 'TBA' }}</td>
                        <td style="font-size:13px;color:#64748b">{{ $event->location ?? '—' }}</td>
                    </tr>
                    @endforeach
                    @if($recentEvents->isEmpty())
                        <tr class="table-empty"><td colspan="3">No events yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection



