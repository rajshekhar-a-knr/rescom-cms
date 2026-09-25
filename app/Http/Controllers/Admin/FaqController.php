<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller {
    public function index() { $faqs = Faq::orderBy('sort_order')->get(); return view('admin.pages.faqs.index', compact('faqs')); }
    public function create() { return view('admin.pages.faqs.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|in:general,process,pricing,technology,security,support,legal',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active',true);
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success','FAQ added!');
    }
    public function edit(Faq $faq) { return view('admin.pages.faqs.form', compact('faq')); }
    public function update(Request $request, Faq $faq) {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|in:general,process,pricing,technology,security,support,legal',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success','FAQ updated!');
    }
    public function destroy(Faq $faq) { $faq->delete(); return redirect()->route('admin.faqs.index')->with('success','Deleted!'); }
}
