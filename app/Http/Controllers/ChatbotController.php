<?php

namespace App\Http\Controllers;

use App\Models\ChatbotFaq;
use App\Models\ChatbotQuery;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $question = trim((string) $request->input('question', ''));

        if ($question === '') {
            return response()->json([
                'matched' => false,
                'answer' => 'Please type a question.',
            ]);
        }

        $enabled = (string) setting('chatbot_enabled', '1');
        if ($enabled !== '1') {
            return response()->json([
                'matched' => false,
                'answer' => 'The chatbot is currently offline. Please contact support.',
                'contact_url' => route('contact'),
            ]);
        }

        $like = '%' . Str::lower($question) . '%';
        $faq = ChatbotFaq::where('is_active', 1)
            ->where(function ($q) use ($like) {
                $q->whereRaw('LOWER(question) LIKE ?', [$like])
                  ->orWhereRaw('LOWER(keywords) LIKE ?', [$like]);
            })
            ->orderByRaw("CASE WHEN LOWER(question) LIKE ? THEN 0 ELSE 1 END", [$like])
            ->orderBy('times_asked', 'desc')
            ->first();

        if ($faq) {
            $faq->increment('times_asked');
            return response()->json([
                'matched' => true,
                'answer' => $faq->answer,
                'faq_id' => $faq->id,
                'suggestions' => $this->suggestions(),
                'related' => $this->relatedLinks($question),
            ]);
        }

        ChatbotQuery::create([
            'user_question' => $question,
            'status' => 'pending',
        ]);

        return response()->json([
            'matched' => false,
            'answer' => "Sorry, I couldn't find an answer to your question.",
            'contact_url' => route('contact'),
            'suggestions' => $this->suggestions(),
            'related' => $this->relatedLinks($question),
        ]);
    }

    private function suggestions(): array
    {
        return ChatbotFaq::where('is_active', 1)
            ->orderBy('times_asked', 'desc')
            ->take(4)
            ->pluck('question')
            ->values()
            ->all();
    }

    private function relatedLinks(string $question): array
    {
        $query = Str::lower($question);
        $keywords = collect(preg_split('/\s+/', $query))
            ->filter(fn($word) => strlen($word) > 2)
            ->unique()
            ->values();

        $links = collect();
        $map = [
            'service' => ['title' => 'Services', 'url' => route('services')],
            'services' => ['title' => 'Services', 'url' => route('services')],
            'solution' => ['title' => 'Solutions', 'url' => route('services')],
            'solutions' => ['title' => 'Solutions', 'url' => route('services')],
            'product' => ['title' => 'Products', 'url' => route('portfolio')],
            'products' => ['title' => 'Products', 'url' => route('portfolio')],
            'portfolio' => ['title' => 'Products', 'url' => route('portfolio')],
            'contact' => ['title' => 'Contact', 'url' => route('contact')],
            'about' => ['title' => 'About', 'url' => route('about')],
            'blog' => ['title' => 'Blogs', 'url' => route('blog')],
            'career' => ['title' => 'Careers', 'url' => route('careers')],
            'careers' => ['title' => 'Careers', 'url' => route('careers')],
            'event' => ['title' => 'Events', 'url' => route('events')],
            'events' => ['title' => 'Events', 'url' => route('events')],
            'faq' => ['title' => 'FAQs', 'url' => route('faqs.page')],
            'faqs' => ['title' => 'FAQs', 'url' => route('faqs.page')],
        ];

        foreach ($map as $key => $link) {
            if (Str::contains($query, $key)) {
                $links->push($link);
            }
        }

        if (class_exists(Page::class)) {
            $pageQuery = Page::query()->where('status', 'published');
            if ($keywords->isNotEmpty()) {
                $pageQuery->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('title', 'like', '%' . $word . '%');
                    }
                });
            }
            $pages = $pageQuery->orderBy('sort_order')->limit(3)->get();
            foreach ($pages as $page) {
                $links->push([
                    'title' => $page->title,
                    'url' => route('page.show', $page->slug),
                ]);
            }
        }

        return $links->unique('url')->take(4)->values()->all();
    }
}

