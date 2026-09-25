<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $type = request('type');
        $types = Event::query()
            ->where('is_active', 1)
            ->whereNotNull('event_type')
            ->where('event_type', '!=', '')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        $events = Event::where('is_active', 1)
            ->when($type, fn($q) => $q->where('event_type', $type))
            ->orderByRaw('event_date is null')
            ->orderBy('event_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.events.index', compact('events', 'types', 'type'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        $event->load('photos');
        return view('pages.events.show', compact('event'));
    }
}
