<?php

namespace App\Http\Controllers;

use App\Models\User;
use Redirect;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models;
// база данных testdb


class SiteController extends Controller
{
    public function login_show(){

        return view('login');
    }
    public function login_post(Request $request){

        return dd($request);
    }
    public function register_show(){

        return view('register');
    }
    public function register_post(Request $request){
        return dd($request);
        //return dd(DB::table("test_models")->get());

    }
    public function main_show(){
        return view('main');
    }
    public function contacts(){
        return view('contacts');
    }
    public function contacts_post(Request $request){
        return dd($request);
    }
    public function purchase(){
        return view('purchase');
    }
    public function booking(){
        return view('booking');
    }
    public function booking_post(Request $request){
        return dd($request);
    }
    public function stuff(){
        return view('stuff');
    }
    public function cancelling(){
        return view('cancelling');
    }
    public function cancelling_post(Request $request){
        return dd($request);
    }
    public function schedule(){
        return view('schedule');
    }

    //
}
