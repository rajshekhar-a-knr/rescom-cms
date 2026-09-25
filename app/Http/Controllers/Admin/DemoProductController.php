<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoProduct;
use App\Models\DemoProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DemoProductController extends Controller
{
    public function index()
    {
        $products = DemoProduct::withCount('requests')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(20);

        $demoRequests = DemoProductRequest::with('product')
            ->latest()
            ->take(50)
            ->get();

        return view('admin.pages.demo-products.index', compact('products', 'demoRequests'));
    }

    public function create()
    {
        return view('admin.pages.demo-products.form');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($request->title);
        $data = $this->prepareData($request, $data);

        $created = DemoProduct::create($data);

        // Keep Product (Portfolio) sorting order in sync
        \App\Models\Portfolio::where('slug', $created->slug)
            ->orWhere('title', $created->title)
            ->update(['sort_order' => $created->sort_order]);

        return redirect()->route('admin.demo-products.index')->with('success', 'Demo product added!');
    }

    public function edit(DemoProduct $demoProduct)
    {
        return view('admin.pages.demo-products.form', compact('demoProduct'));
    }

    public function update(Request $request, DemoProduct $demoProduct)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($request->title, $demoProduct->id);
        $data = $this->prepareData($request, $data);

        $demoProduct->update($data);

        // Keep Product (Portfolio) sorting order in sync
        \App\Models\Portfolio::where('slug', $demoProduct->slug)
            ->orWhere('title', $demoProduct->title)
            ->update(['sort_order' => $demoProduct->sort_order]);

        return redirect()->route('admin.demo-products.index')->with('success', 'Demo product updated!');
    }

    public function destroy(DemoProduct $demoProduct)
    {
        $demoProduct->delete();

        return redirect()->route('admin.demo-products.index')->with('success', 'Demo product deleted!');
    }

    public function toggle(DemoProduct $demoProduct)
    {
        $demoProduct->update(['is_active' => ! $demoProduct->is_active]);

        return response()->json(['success' => true]);
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'features_raw' => 'nullable|string|max:2000',
            'demo_url' => 'nullable|url|max:255',
            'login_url' => 'nullable|url|max:255',
            'credential_email' => 'nullable|email|max:255',
            'credential_username' => 'nullable|string|max:255',
            'credential_password' => 'nullable|string|max:2000',
            'credential_notes' => 'nullable|string|max:5000',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'image' => 'nullable|image|max:5120',
            'preview_video' => 'nullable|file|mimes:mp4,mov,webm,ogg|max:51200',
            'is_active' => 'nullable|boolean',
        ]);
    }

    private function prepareData(Request $request, array $data): array
    {
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'demo-products');
        }

        if ($request->hasFile('preview_video')) {
            $data['preview_video'] = upload_to_storage($request->file('preview_video'), 'demo-products/previews');
        }

        $data['features'] = collect(preg_split('/\r\n|\r|\n/', (string) $request->features_raw))
            ->map(fn ($feature) => trim($feature))
            ->filter()
            ->values()
            ->all();

        $data['sort_order'] = $request->integer('sort_order', 0);
        $data['is_active'] = $request->boolean('is_active');
        unset($data['features_raw']);

        return $data;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 2;

        while (DemoProduct::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
