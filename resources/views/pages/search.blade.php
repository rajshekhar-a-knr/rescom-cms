@extends('layouts.app')
@section('title', 'Search')

@section('content')
<div class="page-hero">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-search"></i> Search
        </div>
        <h1>Search Results</h1>
        <p>Find pages, services, Products, events, blog posts, and more across Rescom.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <form action="{{ route('search') }}" method="GET" class="search-bar">
            <input type="text" name="q" value="{{ $q }}" placeholder="Search across the website..." required>
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </form>

        @php
            $total = collect($results)->flatten(1)->count();
        @endphp

        @if(!$q)
            <div class="search-empty">
                <i class="fas fa-magnifying-glass"></i>
                <h3>Start typing to search</h3>
                <p>Try searching for services, Products, events, or blog articles.</p>
            </div>
        @elseif($total === 0)
            <div class="search-empty">
                <i class="fas fa-face-sad-tear"></i>
                <h3>No results found</h3>
                <p>Try a different keyword or browse our main sections.</p>
            </div>
        @else
            @foreach($results as $section => $items)
                @if(count($items))
                <div class="search-section">
                    <div class="search-section-title">{{ $section }}</div>
                    <div class="search-list">
                        @foreach($items as $item)
                        <a class="search-item" href="{{ $item['url'] }}">
                            <h4>{{ $item['title'] }}</h4>
                            @if(!empty($item['snippet']))
                                <p>{{ $item['snippet'] }}</p>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
</section>
@endsection

