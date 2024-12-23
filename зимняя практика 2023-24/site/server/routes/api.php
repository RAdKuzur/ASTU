<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test',  [SiteController::class, 'test'])->name('test');
Route::post('/login',  [SiteController::class, 'login'])->name('login');
Route::get('/profile',  [SiteController::class, 'profile'])->name('profile');

Route::get('/register_get',  [SiteController::class, 'register_get'])->name('register_get');
Route::post('/register_post',  [SiteController::class, 'register_post'])->name('register_post');

Route::post('/contacts_post',  [SiteController::class, 'contacts_post'])->name('contacts_post');

Route::get('/booking',  [SiteController::class, 'booking'])->name('booking');
Route::post('/booking',  [SiteController::class, 'booking_post'])->name('booking_post');

Route::get('/booking_id',  [SiteController::class, 'booking_id'])->name('booking_id');
Route::post('/booking_id_post',  [SiteController::class, 'booking_id_post'])->name('booking_id_post');

Route::post('/cancelling_post',  [SiteController::class, 'cancelling_post'])->name('cancelling_post');

Route::get('/schedule',  [SiteController::class, 'schedule'])->name('schedule');

Route::get('/run_auth',  [SiteController::class, 'run_auth'])->name('run_auth');
Route::get('/run',  [SiteController::class, 'run'])->name('run');
Route::post('/run_post',  [SiteController::class, 'run_post'])->name('run_post');

Route::get('/comment',  [SiteController::class, 'comment'])->name('comment');

Route::get('/other',  [SiteController::class, 'other'])->name('other');
Route::post('/other',  [SiteController::class, 'other_post'])->name('other_post');


Route::get('/auto',  [SiteController::class, 'auto_run'])->name('auto_run');
