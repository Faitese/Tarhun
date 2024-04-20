<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\teams;
use Ramsey\Uuid\Type\Integer;
use Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;



class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $players = Player::all();
        $teams1 = teams::where('verified', 1)->orderBy('points')->get();
        $teams2 = $teams1->map(function ($team) {
            return [
                'id' => $team->id,
                'name' => $team->name,
                'points' => $team->points,
                'logo_path' => asset('/storage/' . $team->logo_path),
                'verified' => $team->verified,

            ];
        })->toArray();
        $teams = array_reverse($teams2);
        foreach ($players as $index => $player) {
            foreach ($teams as $index1 => $team) {
                if($player['team_id'] == $team['id']) {
                    $teams[$index1]['players'][$index]['id'] = $player['id'];
                    $teams[$index1]['players'][$index]['nickname'] = $player['nickname'];
                    $teams[$index1]['players'][$index]['photo'] = "storage/" . $player['photo'];
                }
            }
        }
//        dd($teams);
        return Inertia::render('Teams/Index', ['teams' => $teams, 'authr' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return Inertia::render('Teams/Create', ['authr' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd(Request::file('logo_path')->store('logos', 'public'));
        $image = Request::file('logo_path')->store('logos', 'public');
        teams::create([
            'name' => Request::input('name'),
            'points' => 0,
            'logo_path' => $image,

        ]);
        return Redirect::route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(teams $teams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teams $team)
    {
        $user = Auth::user();
        return Inertia::render('Teams/Edit', ['team' => $team, 'authr' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, teams $team)
    {
//        dd(Request::input('points'));
//        $team = teams::where('id', $team);
//        dd($team);
        $team->update([
            'name' => Request::input('name'),
            'points' => Request::input('points')
        ]);
        return redirect()->route('index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teams $team)
    {
//        dd($team);
//        dd(teams::where('id', $id));
//        $teams->where()->delete();
    $team->delete();
        Return redirect()->back();
    }

    public function tickets()
    {
        $user = Auth::user();
        $teams1 = teams::orderBy('points')->get();
        $teams2 = $teams1->map(function ($team) {
            return [
                'id' => $team->id,
                'name' => $team->name,
                'points' => $team->points,
                'verified' => $team->verified,
                'logo_path' => asset('/storage/' . $team->logo_path),

            ];
        })->toArray();
        $teams = array_reverse($teams2);
//        dd($teams);
//        dd($teams);
        return Inertia::render('Teams/Tickets', ['teams' => $teams, 'authr' => $user]);
    }

    public function verify(Request $request, teams $team)
    {
//        dd(Request::input('points'));
//        $team = teams::where('id', $team);
//        dd($team);
//        dd($team);
        $team1 = teams::where('id', $team['id']);
        $team1->update([
            "verified" => 1
        ]);
        return redirect()->route('index');

    }
}
