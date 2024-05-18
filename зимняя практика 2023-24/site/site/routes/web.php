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
Route::get('/test',  [SiteController::class, 'test'])->name('test');

Route::get('/login',  [SiteController::class, 'login_show'])->name('login');
Route::post('/login',  [SiteController::class, 'login_post'])->name('login_post');

Route::get('/register',  [SiteController::class, 'register_show'])->name('register');
Route::post('/register',  [SiteController::class, 'register_post'])->name('register_post');

Route::get('/main',  [SiteController::class, 'main_show'])->name('main');

Route::get('/contacts',  [SiteController::class, 'contacts'])->name('contacts');
Route::post('/contacts',  [SiteController::class, 'contacts_post'])->name('contacts_post');

Route::get('/profile',  [SiteController::class, 'profile'])->name('profile');
Route::post('/profile',  [SiteController::class, 'profile_post'])->name('profile_post');

Route::get('/purchase',  [SiteController::class, 'purchase'])->name('purchase');

Route::get('/stuff',  [SiteController::class, 'stuff'])->name('stuff');
Route::get('/schedule',  [SiteController::class, 'schedule'])->name('schedule');

Route::get('/purchase/booking',  [SiteController::class, 'booking'])->name('booking');
Route::post('/purchase/booking',  [SiteController::class, 'booking_post'])->name('booking_post');

Route::get('/purchase/booking/{id}',  [SiteController::class, 'booking_id'])->name('booking_id');
Route::post('/purchase/booking/{id}',  [SiteController::class, 'booking_id_post'])->name('booking_id_post');


Route::get('/purchase/cancelling',  [SiteController::class, 'cancelling'])->name('cancelling');
Route::post('/purchase/cancelling',  [SiteController::class, 'cancelling_post'])->name('cancelling_post');

Route::get('/stuff/run',  [SiteController::class, 'run'])->name('run');
Route::post('/stuff/run',  [SiteController::class, 'run_post'])->name('run_post');

Route::get('/stuff/other',  [SiteController::class, 'other'])->name('other_post');
Route::post('/stuff/other',  [SiteController::class, 'other_post'])->name('other_post');

Route::get('/stuff/comment',  [SiteController::class, 'comment'])->name('comment');

Route::get('/', function () {
    return redirect("main");
});
