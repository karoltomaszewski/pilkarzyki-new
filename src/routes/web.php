<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PlayersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get("/players", [PlayersController::class, 'index'])->name('players.list');
    Route::get("/players/{player}", [PlayersController::class, 'show'])->name('players.show');

    Route::post("/players", [PlayersController::class, 'store'])->name('players.store');
    Route::get("/tournaments/new", [PlayersController::class, 'index'])->name('tournaments.new');

    Route::get('/l', [LoginController::class, 'logout'])->name('logout');
});

// Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'showRegister'])->name('showRegister');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
// });

Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

