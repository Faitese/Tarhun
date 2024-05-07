<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\teams;
use App\Models\Tour;
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
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
