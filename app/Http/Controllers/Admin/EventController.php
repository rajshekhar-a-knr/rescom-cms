<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $type = request('type');
        $types = Event::query()
            ->whereNotNull('event_type')
            ->where('event_type', '!=', '')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        $events = Event::query()
            ->when($type, fn($q) => $q->where('event_type', $type))
            ->orderBy('event_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.events.index', compact('events', 'types', 'type'));
    }

    public function create()
    {
        $types = Event::query()
            ->whereNotNull('event_type')
            ->where('event_type', '!=', '')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        return view('admin.pages.events.form', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'event_type' => 'nullable|string|max:100',
            'summary' => 'nullable|max:255',
            'description' => 'nullable',
            'event_date' => 'nullable|date',
            'location' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
            'photos' => 'nullable|array',
            'photos.*' => 'image',
        ]);

        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);
        $data['is_active'] = $request->boolean('is_active', true);
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'events');
        }

        $event = Event::create($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                if (!$file) continue;
                $path = upload_to_storage($file, 'events/gallery');
                EventPhoto::create([
                    'event_id' => $event->id,
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        $this->syncEventGalleryItems($event);

        return redirect()->route('admin.events.index')->with('success', 'Event added!');
    }

    public function edit(Event $event)
    {
        $types = Event::query()
            ->whereNotNull('event_type')
            ->where('event_type', '!=', '')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        return view('admin.pages.events.form', compact('event', 'types'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'event_type' => 'nullable|string|max:100',
            'summary' => 'nullable|max:255',
            'description' => 'nullable',
            'event_date' => 'nullable|date',
            'location' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
            'photos' => 'nullable|array',
            'photos.*' => 'image',
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'integer',
            'photo_order' => 'nullable|array',
            'photo_order.*' => 'integer',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'events');
        }

        $event->update($data);

        if ($request->filled('remove_photos')) {
            $disk = config('filesystems.default', 'public');
            $photos = EventPhoto::where('event_id', $event->id)
                ->whereIn('id', $request->input('remove_photos', []))
                ->get();
            foreach ($photos as $photo) {
                Storage::disk($disk)->delete($photo->image);
                $photo->delete();
            }
        }

        if ($request->hasFile('photos')) {
            $existingMax = (int) $event->photos()->max('sort_order');
            $start = $existingMax >= 0 ? $existingMax + 1 : 0;
            foreach ($request->file('photos') as $index => $file) {
                if (!$file) continue;
                $path = upload_to_storage($file, 'events/gallery');
                EventPhoto::create([
                    'event_id' => $event->id,
                    'image' => $path,
                    'sort_order' => $start + $index,
                ]);
            }
        }

        if ($request->filled('photo_order')) {
            foreach ($request->input('photo_order', []) as $index => $photoId) {
                EventPhoto::where('event_id', $event->id)
                    ->where('id', $photoId)
                    ->update(['sort_order' => $index]);
            }
        }

        $this->syncEventGalleryItems($event);

        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    public function destroy(Event $event)
    {
        GalleryItem::where('event_id', $event->id)->delete();
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }

    private function syncEventGalleryItems(Event $event): void
    {
        GalleryItem::where('event_id', $event->id)->delete();

        $category = $event->event_type ?: 'Events';
        $baseData = [
            'title' => $event->title,
            'caption' => $event->summary,
            'category' => $category,
            'event_id' => $event->id,
            'is_active' => true,
            'sort_order' => 0,
        ];

        if ($event->image) {
            GalleryItem::create(array_merge($baseData, ['image' => $event->image]));
        }

        $photos = $event->photos()->orderBy('sort_order')->orderBy('created_at')->get();
        foreach ($photos as $photo) {
            if (!$photo->image) continue;
            GalleryItem::create(array_merge($baseData, ['image' => $photo->image]));
        }
    }
}
