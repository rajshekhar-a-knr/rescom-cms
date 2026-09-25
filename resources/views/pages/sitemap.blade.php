<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>{{ url('/about') }}</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/services') }}</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ url('/portfolio') }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/blog') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/gallery') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/events') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/careers') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/contact') }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    @foreach($services as $s)<url><loc>{{ url('/services/'.$s->slug) }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>@endforeach
    @foreach($portfolios as $p)<url><loc>{{ url('/portfolio/'.$p->slug) }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>@endforeach
    @foreach($blogs as $b)<url><loc>{{ url('/blog/'.$b->slug) }}</loc><lastmod>{{ $b->updated_at->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>@endforeach
    @foreach($events as $e)<url><loc>{{ url('/events/'.$e->slug) }}</loc><lastmod>{{ $e->updated_at->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>@endforeach
</urlset>
