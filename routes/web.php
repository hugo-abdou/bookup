<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::get('/builder', function () {
    return inertia('Builder');
});

Route::get('/reset', function () {
    try {
        Artisan::call('migrate:fresh --seed');
    } catch (\Throwable $th) {
        throw $th;
    }
    return redirect('/login');
})->name('reset');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // users routes
    Route::resource('users', UserController::class);

    // roles routes
    Route::resource('roles', RoleController::class);

    // projects routes
    Route::resource('projects', ProjectController::class);
});
