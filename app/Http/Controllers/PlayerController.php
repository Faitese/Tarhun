<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use App\Models\teams;
use Illuminate\Support\Facades\Auth;
use Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $teams = teams::all();
        $player1 = Player::orderBy('id')->get();
        $players = $player1->map(function ($player) {
            return [
                'id' => $player->id,
                'nickname' => $player->nickname,
                'fi' => $player->fi,
                'team_id' => $player->team_id,
                'verified' => $player->verified,
                'photo' => asset('storage/' . $player->photo),

            ];
        })->toArray();
        foreach ($players as $index => $player) {
            foreach ($teams as $index1 => $team) {
                if($player['team_id'] == $team['id']) {
                    $players[$index]['team'] = $team['name'];
                }
            }
        }
//        dd($players);
        return Inertia::render('Players/Tickets', ['players' => $players, 'authr' => $user]);
    }

    public function verify(Request $request, Player $player)
    {
//        dd(Request::input('points'));
//        $team = teams::where('id', $team);
//        dd($team);
//        dd($team);
//        dd($player);
        $player1 = Player::where('id', $player['id']);
        $player1->update([
            "verified" => 1
        ]);
        return redirect()->route('index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $teams = teams::all();
        return Inertia::render('Players/Create', ['authr' => $user, 'teams' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Request::file('photo') != null) {
            $image = Request::file('photo')->store('photos', 'public');
        }
        else {
            $image = null;
        }

        Player::create([
            'team_id' => Request::input('team_id'),
            'nickname' => Request::input('nickname'),
            'fi' => Request::input('fi'),
            'photo' => $image,

        ]);
        return Redirect::route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        $user = Auth::user();
        $teams = teams::all();
//        $player = $player->toArray();
//        dd($player);
        return Inertia::render('Players/Edit', ['player' => $player, 'authr' => $user, 'teams' => $teams]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd(Request::input('points'));
//        $team = teams::where('id', $team);
//        dd($team);
//        dd(Request::input('id'));
        $player = Player::where('id', Request::input('id'));

//        dd($player);
        $player->update([
            'nickname' => Request::input('nickname'),
            'team_id' => Request::input('team_id'),
            'fi' => Request::input('fi'),

        ]);
        return redirect()->route('index');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
//        dd($player);
        if ($player->photo != null) {
            Storage::delete('public/' . $player->photo);
        }
        $player->delete();

        Return redirect()->back();
    }
}
