<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TeamsController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

//Route::Resource('/', TeamsController::class);

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
