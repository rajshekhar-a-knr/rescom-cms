<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pages.gallery.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|max:255',
            'caption' => 'nullable|max:255',
            'category' => 'nullable|max:120',
            'sort_order' => 'nullable|integer',
            'image' => 'required|image',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'gallery');
        }

        GalleryItem::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added!');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.pages.gallery.form', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $request->validate([
            'title' => 'nullable|max:255',
            'caption' => 'nullable|max:255',
            'category' => 'nullable|max:120',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = upload_to_storage($request->file('image'), 'gallery');
        }

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated!');
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted!');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        if (is_array($order)) {
            foreach ($order as $index => $id) {
                GalleryItem::where('id', $id)->update(['sort_order' => $index]);
            }
        }
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery order updated!');
    }
}
