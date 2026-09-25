<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;

class TechnologyController extends Controller {
    public function index() { $technologies = Technology::orderBy('category')->orderBy('sort_order')->get(); return view('admin.pages.technologies.index', compact('technologies')); }
    public function create() { return view('admin.pages.technologies.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|in:frontend,backend,mobile,database,cloud,devops,other',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active',true);
        Technology::create($data);
        return redirect()->route('admin.technologies.index')->with('success','Technology added!');
    }
    public function edit(Technology $technology) { return view('admin.pages.technologies.form', compact('technology')); }
    public function update(Request $request, Technology $technology) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|in:frontend,backend,mobile,database,cloud,devops,other',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $technology->update($data);
        return redirect()->route('admin.technologies.index')->with('success','Updated!');
    }
    public function destroy(Technology $technology) { $technology->delete(); return redirect()->route('admin.technologies.index')->with('success','Deleted!'); }
}
