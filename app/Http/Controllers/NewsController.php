<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use DateTimeInterface;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        function plural($n, $form1, $form2, $form3) {
            $n  = abs($n) % 100;
            $n1 = $n % 10;

            if ($n > 10 && $n < 20) return $form3;
            if ($n1 > 1 && $n1 < 5) return $form2;
            if ($n1 == 1) return $form1;

            return $form3;
        }

        $user = Auth::user();
        $news1 = News::orderBy('created_at')->get();
        $news = $news1->map(function ($new) {
            return [
                'id' => $new->id,
                'title' => $new->title,
                'created_at' => $new->created_at,
            ];
        })->toArray();
        $news = array_reverse($news);
        foreach ($news as $test => $new) {
            $ar = explode(' ', $new['created_at']);
//            $news[$test]['date'] = $ar[0];
//            $news[$test]['time'] = $ar[1];

            $date = $ar[0] . ' ' . $ar[1];
            $date = strtotime($date);
            $Cdate = time();
            $razn = $Cdate - $date;

            $d1 = ($razn - ($razn % 86400)) / 86400;

            $dost = $razn % 86400;
            $h1 = ($dost - ($dost % 3600)) / 3600;

            $dost1 = $dost % 3600;
            $m1 = ($dost1 - ($dost1 % 60)) / 60;

            $s1 = $dost1 % 60;

//            dd($razn);
            if ($d1 != 0) {
                $d = $d1 . plural($d1, " день ", " дня ", " дней ");
            }
            else {
                $d = '';
            }
            if ($h1 != 0) {
                $h = $h1 . plural($h1, " час ", " часа ", " часов ");
            }
            else {
                $h = '';
            }
            if ($m1 != 0 && $d == "") {
                $m = $m1 . plural($m1, " минуту ", " минуты ", " минут ");
            }
            else {
                $m = '';
            }
            if ($s1 != 0  && $h == '') {
                $s = $s1 . plural($s1, " секунду ", " секунды ", " секунд ");
            }
            else {
                $s = '';
            }
            $news[$test]['time'] = $d . $h . $m . $s . 'назад';
            //dd($news[$test]);
        }
//        dd($news);

        return Inertia::render('News/Index', ['news' => $news, 'authr' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return Inertia::render('News/Create', ['authr' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Request::file('img') != null) {
            $image = Request::file('img')->store('news', 'public');
        }
        else {
            $image = null;
        }
//        dd(Request::input('title'));
        News::create([
            'title' => Request::input('title'),
            'content' => nl2br(Request::input('content'), false),
            'img' => $image,

        ]);
        return Redirect::route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $news)
    {
        settype($news, 'integer');
        $new = News::where('id', $news)->first()->toArray();
//        dd($new);
        $user = Auth::user();
        if ($new['img'] == "") {
            $new['img'] = null;
        }
        else {
            $new['img'] = asset('storage/' . $new['img']);
        }
        return Inertia::render('News/Show', ['authr' => $user, 'new1' => $new]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $news)
    {
        settype($news, 'integer');
        $user = Auth::user();

        $news = News::where('id', $news)->first()->toArray();
//        dd($news);
        return Inertia::render('News/Edit', ['authr' => $user, 'new1' => $news]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $news)
    {
        settype($news, 'integer');

        $new = News::where('id', $news);
        $new1 = Request::all();
//        dd($new1['content']);
//        dd(nl2br($new1['content'], false));
        $new->update([
            'title' => $new1['title'],
            'content' => nl2br($new1['content'], false)

        ]);
        return redirect()->route('news.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $news)
    {

        settype($news, 'integer');

        $news = News::where('id', $news)->first();

//        dd($news);
        if ($news->img != "") {
            Storage::delete('public/' . $news->img);
        }
        $news->delete();

        Return redirect()->route('news.index');
    }
}
