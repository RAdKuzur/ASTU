<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SiteController;
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

Route::get('/login',  [SiteController::class, 'login_show'])->name('login');
Route::post('/login',  [SiteController::class, 'login_post'])->name('login_post');



Route::get('/register',  [SiteController::class, 'register_show'])->name('register');
Route::post('/register',  [SiteController::class, 'register_post'])->name('register_post');

Route::get('/main',  [SiteController::class, 'main_show'])->name('main');
Route::get('/', function () {
    return redirect("main");
});
