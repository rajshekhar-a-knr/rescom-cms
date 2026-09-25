<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $items = AboutPage::orderBy('sort_order')->orderBy('id', 'desc')->paginate(20);
        return view('admin.pages.about.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pages.about.form');
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);
        $data['values'] = $this->buildValues($request);
        $data['is_active'] = $request->boolean('is_active');

        $about = AboutPage::create($data);
        if ($about->is_active) {
            AboutPage::where('id', '!=', $about->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.about.index')->with('success', 'About page created.');
    }

    public function edit(AboutPage $about)
    {
        return view('admin.pages.about.form', compact('about'));
    }

    public function update(Request $request, AboutPage $about)
    {
        $data = $this->validatePayload($request);
        $data['values'] = $this->buildValues($request);
        $data['is_active'] = $request->boolean('is_active');

        $about->update($data);
        if ($about->is_active) {
            AboutPage::where('id', '!=', $about->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.about.index')->with('success', 'About page updated.');
    }

    public function destroy(AboutPage $about)
    {
        $about->delete();
        return redirect()->route('admin.about.index')->with('success', 'About page deleted.');
    }

    protected function validatePayload(Request $request): array
    {
        return $request->validate([
            'hero_badge' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_highlight' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:1000',
            'story_badge' => 'nullable|string|max:255',
            'story_title' => 'nullable|string|max:255',
            'story_highlight' => 'nullable|string|max:255',
            'story_body_1' => 'nullable|string|max:2000',
            'story_body_2' => 'nullable|string|max:2000',
            'vision_title' => 'nullable|string|max:255',
            'vision_body' => 'nullable|string|max:1200',
            'mission_title' => 'nullable|string|max:255',
            'mission_body' => 'nullable|string|max:1200',
            'values_title' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }

    protected function buildValues(Request $request): array
    {
        $values = [];
        for ($i = 1; $i <= 5; $i++) {
            $title = trim((string) $request->input("value_{$i}_title"));
            $desc = trim((string) $request->input("value_{$i}_desc"));
            $icon = trim((string) $request->input("value_{$i}_icon"));
            if ($title || $desc) {
                $values[] = [
                    'icon' => $icon ?: 'fas fa-star',
                    'title' => $title,
                    'desc' => $desc,
                ];
            }
        }
        return $values;
    }
}
