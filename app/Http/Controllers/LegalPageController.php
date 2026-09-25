<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;

class LegalPageController extends Controller
{
    public function show(string $slug)
    {
        $page = LegalPage::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        return view('pages.legal', compact('page'));
    }
}
