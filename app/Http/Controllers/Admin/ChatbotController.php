<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotFaq;
use App\Models\ChatbotQuery;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatbotFaq::query();

        if ($request->filled('q')) {
            $q = trim($request->input('q'));
            $like = '%' . $q . '%';
            $query->where(function ($q2) use ($like) {
                $q2->where('question', 'like', $like)
                    ->orWhere('answer', 'like', $like)
                    ->orWhere('keywords', 'like', $like);
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $faqs = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        $categories = ChatbotFaq::select('category')->distinct()->orderBy('category')->pluck('category');
        $chatbotEnabled = setting('chatbot_enabled', '1') === '1';
        $pendingCount = ChatbotQuery::where('status', 'pending')->count();

        return view('admin.pages.chatbot.index', compact('faqs', 'categories', 'chatbotEnabled', 'pendingCount'));
    }

    public function create()
    {
        return view('admin.pages.chatbot.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:60',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keywords' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        ChatbotFaq::create($data);

        return redirect()->route('admin.chatbot.index')->with('success', 'FAQ added successfully.');
    }

    public function edit(ChatbotFaq $chatbot)
    {
        return view('admin.pages.chatbot.form', ['faq' => $chatbot]);
    }

    public function update(Request $request, ChatbotFaq $chatbot)
    {
        $data = $request->validate([
            'category' => 'required|string|max:60',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keywords' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $chatbot->update($data);

        return redirect()->route('admin.chatbot.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(ChatbotFaq $chatbot)
    {
        $chatbot->delete();
        return back()->with('success', 'FAQ deleted.');
    }

    public function toggle(ChatbotFaq $chatbot)
    {
        $chatbot->update(['is_active' => !$chatbot->is_active]);
        return back()->with('success', 'FAQ status updated.');
    }

    public function queries(Request $request)
    {
        $query = ChatbotQuery::query();

        if ($request->filled('q')) {
            $like = '%' . trim($request->input('q')) . '%';
            $query->where('user_question', 'like', $like);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $queries = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin.pages.chatbot.queries', compact('queries'));
    }

    public function respond(Request $request, ChatbotQuery $query)
    {
        $data = $request->validate([
            'admin_response' => 'required|string',
        ]);

        $query->update([
            'admin_response' => $data['admin_response'],
            'status' => 'resolved',
        ]);

        return back()->with('success', 'Response saved.');
    }

    public function convert(ChatbotQuery $query)
    {
        $question = Str::limit($query->user_question, 255, '');
        $faq = ChatbotFaq::create([
            'category' => 'General',
            'question' => $question,
            'answer' => $query->admin_response ?: 'Thanks for asking! Our team will update this answer shortly.',
            'keywords' => null,
            'is_active' => true,
        ]);

        $query->update([
            'status' => 'resolved',
            'resolved_faq_id' => $faq->id,
        ]);

        return back()->with('success', 'Converted to FAQ.');
    }

    public function settings(Request $request)
    {
        $enabled = $request->boolean('chatbot_enabled');

        Setting::updateOrCreate(
            ['key' => 'chatbot_enabled'],
            ['value' => $enabled ? '1' : '0', 'group' => 'content']
        );

        if (function_exists('clear_settings_cache')) {
            clear_settings_cache();
        }

        return back()->with('success', 'Chatbot settings updated.');
    }
}
