<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\TopScroller;
use Illuminate\Http\Request;

class TopScrollerController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', ['header'])->get()->keyBy('key');
        $items = TopScroller::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.pages.settings.topscroller.index', compact('settings', 'items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        TopScroller::create($data);

        return back()->with('success', 'Scroller item added!');
    }

    public function edit(TopScroller $topScroller)
    {
        $settings = Setting::whereIn('group', ['header'])->get()->keyBy('key');

        return view('admin.pages.settings.topscroller.form', compact('settings', 'topScroller'));
    }

    public function update(Request $request, TopScroller $topScroller)
    {
        $data = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $topScroller->update($data);

        return redirect()->route('admin.settings.topscroller')->with('success', 'Scroller item updated!');
    }

    public function destroy(TopScroller $topScroller)
    {
        $topScroller->delete();

        return back()->with('success', 'Scroller item deleted!');
    }

    public function toggle(TopScroller $topScroller)
    {
        $topScroller->update(['is_active' => !$topScroller->is_active]);

        return back()->with('success', 'Scroller item status updated!');
    }
}
