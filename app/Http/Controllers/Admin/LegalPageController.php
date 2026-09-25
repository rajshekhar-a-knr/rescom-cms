<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LegalPageController extends Controller
{
    public function index()
    {
        $pages = LegalPage::orderBy('sort_order')->paginate(20);
        return view('admin.pages.legal-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.legal-pages.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:legal_pages,slug',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['slug'] ?? Str::slug($request->title));
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['is_active'] = $request->boolean('is_active');

        LegalPage::create($data);
        return redirect()->route('admin.legal-pages.index')->with('success', 'Legal page created!');
    }

    public function edit(LegalPage $legalPage)
    {
        return view('admin.pages.legal-pages.form', ['page' => $legalPage]);
    }

    public function update(Request $request, LegalPage $legalPage)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:legal_pages,slug,' . $legalPage->id,
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $data['slug'] ? $data['slug'] : Str::slug($request->title);
        $data['slug'] = $this->makeUniqueSlug($data['slug'], $legalPage->id);
        $data['sort_order'] = $request->input('sort_order', $legalPage->sort_order ?? 0);
        $data['is_active'] = $request->boolean('is_active');

        $legalPage->update($data);
        return redirect()->route('admin.legal-pages.index')->with('success', 'Legal page updated!');
    }

    public function destroy(LegalPage $legalPage)
    {
        $legalPage->delete();
        return redirect()->route('admin.legal-pages.index')->with('success', 'Legal page deleted!');
    }

    private function makeUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $counter = 2;
        while (LegalPage::where('slug', $candidate)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $base . '-' . $counter;
            $counter++;
        }
        return $candidate;
    }
}
