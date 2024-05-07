<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TeamsController;
use \App\Http\Controllers\PlayerController;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\TourController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::get('/news/{new}/show', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/{new}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('/news/update/{new}', [NewsController::class, 'update'])->name('news.update');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');

Route::get('/Tour', [TourController::class, 'index'])->name('tour.index');
Route::get('/Tour/create', [TourController::class, 'create'])->name('tour.create');
Route::get('/Tour/{new}/show', [TourController::class, 'show'])->name('tour.show');
Route::get('/Tour/{new}/edit', [TourController::class, 'edit'])->name('tour.edit');
Route::put('/Tour/update/{new}', [TourController::class, 'update'])->name('tour.update');
Route::post('/Tour', [TourController::class, 'store'])->name('tour.store');


Route::get('/player', [PlayerController::class, 'index'])->name('player.index');
Route::get('/player/create', [PlayerController::class, 'create'])->name('player.create');
//Route::get('/player/tickets', [PlayerController::class, 'tickets'])->name('player.tickets');
Route::put('/player/{player}', [PlayerController::class, 'verify'])->name('player.verify');
Route::post('/player', [PlayerController::class, 'store'])->name('player.store');
Route::delete('/player/{player}', [PlayerController::class, 'destroy'])->name('player.destroy');
Route::get('/player/{player}/edit', [PlayerController::class, 'edit'])->name('player.edit');
Route::put('/player/update/{team}', [PlayerController::class, 'update'])->name('player.update');


Route::get('/', [TeamsController::class, 'index'])->name('index');
Route::get('/tickets', [TeamsController::class, 'tickets'])->name('tickets');
Route::post('/', [TeamsController::class, 'store'])->name('store');
Route::get('/create', [TeamsController::class, 'create'])->name('create');
Route::get('/{team}/edit', [TeamsController::class, 'edit'])->name('edit');
Route::put('/teams/{team}', [TeamsController::class, 'update'])->name('update');
Route::delete('/{team}', [TeamsController::class, 'destroy'])->name('destroy');
Route::put('/{team}', [TeamsController::class, 'verify'])->name('verify');



Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
