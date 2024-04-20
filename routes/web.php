<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TeamsController;
use \App\Http\Controllers\PlayerController;
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::get('/player', [PlayerController::class, 'index'])->name('player.index');
Route::get('/player/create', [PlayerController::class, 'create'])->name('player.create');
Route::get('/player/tickets', [PlayerController::class, 'tickets'])->name('player.tickets');
Route::put('/player/{player}', [PlayerController::class, 'verify'])->name('player.verify');
Route::post('/player', [PlayerController::class, 'store'])->name('player.store');



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
