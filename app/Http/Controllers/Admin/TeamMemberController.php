<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'linkedin'   => 'nullable|string|max:255',
            'twitter'    => 'nullable|string|max:255',
            'email'      => 'nullable|email',
            'sort_order' => 'nullable|integer',
        ]);
        $v['is_active'] = $request->has('is_active');
        if ($request->hasFile('photo')) {
            $v['photo'] = $request->file('photo')->store('team', 'public');
        }
        TeamMember::create($v);
        return redirect()->route('admin.team.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $v = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'linkedin'   => 'nullable|string|max:255',
            'twitter'    => 'nullable|string|max:255',
            'email'      => 'nullable|email',
            'sort_order' => 'nullable|integer',
        ]);
        $v['is_active'] = $request->has('is_active');
        if ($request->hasFile('photo')) {
            $v['photo'] = $request->file('photo')->store('team', 'public');
        }
        $team->update($v);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }
}
