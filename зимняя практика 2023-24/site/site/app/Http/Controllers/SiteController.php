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


class SiteController extends Controller
{
    public function register_show(){
       
        return view('register');
    }
    public function main_show(){
        return view('main');
    }

    //
}
