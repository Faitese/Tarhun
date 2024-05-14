<?php

namespace App\Http\Controllers;

use App\Models\Player;
//use App\Models\Team;
use App\Models\teams;
use App\Models\Tour;
use PhpParser\Node\Stmt\Return_;
use Ramsey\Uuid\Type\Integer;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $news1 = Tour::orderBy('start_date')->get();
        $news = $news1->map(function ($new) {
            return [
                'id' => $new->id,
                'name' => $new->name,
                'prize_pool' => $new->prize_pool,
                'start_date' => $new->start_date,
                'end_date' => $new->end_date,
                'teams' => $new->teams,
                'org_img' => asset('/storage/' . $new->org_img),
                'large_img' => asset('/storage/' . $new->large_img),

            ];
        })->toArray();
        foreach ($news as $i => $new) {
            $startA = explode('-', $new['start_date']);
            $m = $startA[1];
            if ($m == "01") {
                $news[$i]['start_date'] = 'января';
            }
            if ($m == "02") {
                $news[$i]['start_date'] = 'февраля';
            }
            if ($m == "03") {
                $news[$i]['start_date'] = 'марта';
            }
            if ($m == "04") {
                $news[$i]['start_date'] = 'апреля';
            }
            if ($m == "05") {
                $news[$i]['start_date'] = 'мая';
            }
            if ($m == "06") {
                $news[$i]['start_date'] = 'июня';
            }
            if ($m == "07") {
                $news[$i]['start_date'] = 'июля';
            }
            if ($m == "08") {
                $news[$i]['start_date'] = 'августа';
            }
            if ($m == "09") {
                $news[$i]['start_date'] = 'сентября';
            }
            if ($m == "10") {
                $news[$i]['start_date'] = 'октября';
            }
            if ($m == "11") {
                $news[$i]['start_date'] = 'ноября';
            }
            if ($m == "12") {
                $news[$i]['start_date'] = 'декабря';
            }

            $d = $startA[2];
            if (intval($d) < 10) {
                $d = $d - "0";
            }

            $news[$i]['start_date'] = $d . ' ' . $news[$i]['start_date'];

            $endA = explode('-', $new['end_date']);
            $m = $endA[1];
            if ($m == "01") {
                $news[$i]['end_date'] = 'января';
            }
            if ($m == "02") {
                $news[$i]['end_date'] = 'февраля';
            }
            if ($m == "03") {
                $news[$i]['end_date'] = 'марта';
            }
            if ($m == "04") {
                $news[$i]['end_date'] = 'апреля';
            }
            if ($m == "05") {
                $news[$i]['end_date'] = 'мая';
            }
            if ($m == "06") {
                $news[$i]['end_date'] = 'июня';
            }
            if ($m == "07") {
                $news[$i]['end_date'] = 'июля';
            }
            if ($m == "08") {
                $news[$i]['end_date'] = 'августа';
            }
            if ($m == "09") {
                $news[$i]['end_date'] = 'сентября';
            }
            if ($m == "10") {
                $news[$i]['end_date'] = 'октября';
            }
            if ($m == "11") {
                $news[$i]['end_date'] = 'ноября';
            }
            if ($m == "12") {
                $news[$i]['end_date'] = 'декабря';
            }
            $d = $endA[2];
            if (intval($d) < 10) {
                $d = $d - "0";
            }

            $news[$i]['end_date'] = $d . ' ' . $news[$i]['end_date'];
        }
        $news = array_reverse($news);
//        dd($news);
        foreach ($news as $i2 => $new) {
            $new1 = Tour::find($new['id']);
//            dd($new1);
            $teams = $new1->teams()->get()->toArray();
//            dd($teams);
            foreach ($teams as $ii => $team) {
                $news[$i2]['teams_logos'][$ii] = asset('/storage/' . $team['logo_path']);
            }
        }
//        dd($news);
        return Inertia::render('Tours/Index', [ 'authr' => $user, 'tours' => $news]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $teams = teams::all();
        return Inertia::render('Tours/Create', ['authr' => $user, 'teams' => $teams]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd(Request::input('teams1'));
//        dd(Request::input('teams1'));

        $image_large = Request::file('img_large')->store('tours', 'public');
        $org_image = Request::file('org_img')->store('tours', 'public');

        $tour = Tour::create([
            'name' => Request::input('name'),
            'prize_pool' => Request::input('prize_pool'),
            'start_date' => Request::input('start_date'),
            'end_date' => Request::input('end_date'),
            'teams' => Request::input('teams'),
            'large_img' => $image_large,
            'org_img' => $org_image,
        ]);
        foreach (Request::input('teams1') as $i => $team) {
//            $tour1 = Tour::where('id', $tour['id'])->first();
//            dd($tour1);
            $tour->teams()->attach($team);
        }
        return Redirect::route('tour.index');
    }

    /**
     * Display the specified resource.
     */

    public function assign(Tour $tour) {

    }
    public function show(Int $tour)
    {
        $user = Auth::user();
        $tour1 = Tour::find($tour);
        $tour = $tour1->toArray();
        $startA = explode('-', $tour['start_date']);
        $m = $startA[1];
        if ($m == "01") {
            $tour['start_date'] = 'января';
        }
        if ($m == "02") {
            $tour['start_date'] = 'февраля';
        }
        if ($m == "03") {
            $tour['start_date'] = 'марта';
        }
        if ($m == "04") {
            $tour['start_date'] = 'апреля';
        }
        if ($m == "05") {
            $tour['start_date'] = 'мая';
        }
        if ($m == "06") {
            $tour['start_date'] = 'июня';
        }
        if ($m == "07") {
            $tour['start_date'] = 'июля';
        }
        if ($m == "08") {
            $tour['start_date'] = 'августа';
        }
        if ($m == "09") {
            $tour['start_date'] = 'сентября';
        }
        if ($m == "10") {
            $tour['start_date'] = 'октября';
        }
        if ($m == "11") {
            $tour['start_date'] = 'ноября';
        }
        if ($m == "12") {
            $tour['start_date'] = 'декабря';
        }

        $d = $startA[2];
        if (intval($d) < 10) {
            $d = $d - "0";
        }

        $tour['start_date'] = $d . ' ' . $tour['start_date'];

        $endA = explode('-', $tour['end_date']);
        $m = $endA[1];
        if ($m == "01") {
            $tour['end_date'] = 'января';
        }
        if ($m == "02") {
            $tour['end_date'] = 'февраля';
        }
        if ($m == "03") {
            $tour['end_date'] = 'марта';
        }
        if ($m == "04") {
            $tour['end_date'] = 'апреля';
        }
        if ($m == "05") {
            $tour['end_date'] = 'мая';
        }
        if ($m == "06") {
            $tour['end_date'] = 'июня';
        }
        if ($m == "07") {
            $tour['end_date'] = 'июля';
        }
        if ($m == "08") {
            $tour['end_date'] = 'августа';
        }
        if ($m == "09") {
            $tour['end_date'] = 'сентября';
        }
        if ($m == "10") {
            $tour['end_date'] = 'октября';
        }
        if ($m == "11") {
            $tour['end_date'] = 'ноября';
        }
        if ($m == "12") {
            $tour['end_date'] = 'декабря';
        }
        $d = $endA[2];
        if (intval($d) < 10) {
            $d = $d - "0";
        }

        $tour['year'] = $endA[0];
        $tour['end_date'] = $d . ' ' . $tour['end_date'];
        $tour['org_img'] = asset('/storage/' . $tour['org_img']);
        $tour['large_img'] = asset('/storage/' . $tour['large_img']);
        $teams = $tour1->teams()->get();
        foreach ($teams as $index => $team) {
            $teams[$index]['logo_path'] = asset('/storage/' . $team['logo_path']);
            $teams[$index]['players'] = $team->players()->get()->toArray();
        }
        $tour['teams1'] = $teams->toArray();
//        dd($tour);
        return Inertia::render('Tours/Show', ['authr' => $user, 'tour' => $tour]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $tour)
    {
        $tour = Tour::find($tour);
        $user = Auth::user();
        $tour['teams1'] = $tour->teams()->get();
        foreach ($tour['teams1'] as $i => $team) {
            $tour['teams1'][$i] = $team['id'];
        }
        $teams = teams::all();
//        dd($tour);
        return Inertia::render('Tours/Edit', ['authr' => $user, 'tour' => $tour, 'teams' => $teams]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Int $tour)
    {
        $tour = Tour::find($tour);
//        dd($tour);
        $tour->update([
            'name' => Request::input('name'),
            'prize_pool' => Request::input('prize_pool'),
            'start_date' => Request::input('start_date'),
            'end_date' => Request::input('end_date'),
            'teams' => Request::input('teams'),
        ]);
        $tour->teams()->detach();
        foreach (Request::input('teams1') as $i => $team) {
            $tour->teams()->attach($team);
        }

        Return redirect()->route('tour.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Int $tour)
    {
//        if ($tour->large_ != null) {
//            Storage::delete('public/' . $player->photo);
//        }
        $tour = Tour::find($tour);
//        dd($tour);
        $tour->delete();

        Return redirect()->route('tour.index');
    }
}
