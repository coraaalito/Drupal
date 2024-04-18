<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TeamController;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

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
Route::get('/login-google',[SocialiteController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login-callback', [SocialiteController::class, 'handleProviderCallback']);

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/{slug}', [MainController::class, 'show'])->name('call.show');
Route::get('/equipo/excell', [MainController::class, 'export'])->name('team.export');
Route::get('/equipo/registro/{call}', [MainController::class, 'register'])->name('team.register');
