<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stat;

class StatsController extends Controller {
    public function index() { $stats = Stat::orderBy('sort_order')->get(); return view('admin.pages.stats.index', compact('stats')); }
    public function create() { return view('admin.pages.stats.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active',true);
        Stat::create($data);
        return redirect()->route('admin.stats.index')->with('success','Stat added!');
    }
    public function edit(Stat $stat) { return view('admin.pages.stats.form', compact('stat')); }
    public function update(Request $request, Stat $stat) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $stat->update($data);
        return redirect()->route('admin.stats.index')->with('success','Stat updated!');
    }
    public function destroy(Stat $stat) { $stat->delete(); return redirect()->route('admin.stats.index')->with('success','Deleted!'); }
}
