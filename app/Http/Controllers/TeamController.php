<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show(TeamMember $team)
    {
        if (!$team->is_active) {
            abort(404);
        }

        $team->load('department');
        $others = TeamMember::where('is_active', 1)
            ->where('id', '!=', $team->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('pages.team-detail', [
            'member' => $team,
            'others' => $others,
        ]);
    }
}
