<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::active()->get();
        return view('pages.team', compact('team'));
    }
}
