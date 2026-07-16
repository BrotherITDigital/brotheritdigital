<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('order')->paginate(12);
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio'      => 'nullable|string',
            'email'    => 'nullable|email|max:255',
            'skills'   => 'nullable|string',
            'photo'    => 'nullable|image|max:2048',
            'github'   => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter'  => 'nullable|url',
            'facebook' => 'nullable|url',
            'order'    => 'integer|min:0',
            'is_active'=> 'boolean',
        ]);

        $data['skills'] = $request->skills
            ? array_map('trim', explode(',', $request->skills)) : [];
        $data['social_links'] = array_filter([
            'github'   => $request->github,
            'linkedin' => $request->linkedin,
            'twitter'  => $request->twitter,
            'facebook' => $request->facebook,
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads/team', 'public');
        }

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added!');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio'      => 'nullable|string',
            'email'    => 'nullable|email|max:255',
            'skills'   => 'nullable|string',
            'photo'    => 'nullable|image|max:2048',
            'github'   => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter'  => 'nullable|url',
            'facebook' => 'nullable|url',
            'order'    => 'integer|min:0',
            'is_active'=> 'boolean',
        ]);

        $data['skills'] = $request->skills
            ? array_map('trim', explode(',', $request->skills)) : [];
        $data['social_links'] = array_filter([
            'github'   => $request->github,
            'linkedin' => $request->linkedin,
            'twitter'  => $request->twitter,
            'facebook' => $request->facebook,
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            if ($team->photo) Storage::disk('public')->delete($team->photo);
            $data['photo'] = $request->file('photo')->store('uploads/team', 'public');
        }

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) Storage::disk('public')->delete($team->photo);
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }
}
