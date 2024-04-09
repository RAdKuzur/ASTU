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
        $login = $request->email;
        $password = $request->password;
        $users = DB::table('customers')->where('email', $login)->first();
        if ($users == null){
            return redirect('/login');
        }
        if($users->password == $password) {

            session(['key' => 'auth', 'login' => $users->id]);
            return redirect('/main');
        }
        else {
            return redirect('/login');
        }
    }
    public function profile(){
        $login_id = session('login');
        $login_query = DB::table('customers')->where('id', $login_id)->first();
        $login = $login_query->email;
        $bookings = DB::table('tickets')->where('customer_id',$login_id)->get();
        return view('profile')->with(['login'=>$login, 'bookings' => $bookings]);
    }
    public function profile_post(){
        session(['key' => null, 'login' => null]);
        return redirect('/login');
    }



    public function register_show(){

        return view('register');
    }
    public function register_post(Request $request){
        $login = $request->email;
        $password = $request->password;
        $users = DB::table('customers')->where('email', $login)->first();
        if ($users == null){
            DB::table('customers')->insert(['email' => $login, 'password' => $password]);
            return redirect('/main');
        }
        return redirect('/login');
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
                $cities = DB::table('cities')->get();
                $runs = null;
                return view('booking')->with(['cities' => $cities, 'runs' => $runs]);
    }
    public function booking_post(Request $request){
        $cities = DB::table('cities')->get();
        $departure_city = $request->city_1;
        $arrive_city = $request->city_2;
        $route = DB::table('routes')->where('departure_city_id',$departure_city)
            ->where('arrival_city_id', $arrive_city)->first();
        if($route != null) {
            $route_id = $route->id;
            $runs = DB::table('runs') -> where('route_id', $route_id)->get();
            return view('booking')->with(['runs' => $runs, 'cities'=>$cities]);
        }
        else {
            return redirect('/purchase/booking');
        }
    }

    public function booking_id($id){
        $empty_seats = DB::table('seat_runs')->where('run_id', $id)->where('flag' , 0)->get();
        $number_empty_seats = array();
        foreach ($empty_seats as $seats) {
            $seat_numbers =  DB::table('seats')->where('id', $seats->seat_id)->first();
            array_push($number_empty_seats, $seat_numbers->number);
        }
        return view('bookingId')->with(['id' => $id, 'empty_seats' => $number_empty_seats]);
    }
    public function booking_id_post(Request $request, $id){
        $seats = DB::table('seats')->where('number', $request->seat)->get();
        foreach ($seats as $item){
            $seats_id = $item->id;
            $seats_run_id = DB::table('seat_runs')->where('seat_id', $seats_id)->first();
            if($seats_run_id->run_id == $id)
            {

                DB::table('tickets')->insert(['seat_run_id'=> $seats_run_id->seat_id,
                    'carrier_id' => 1,
                    'customer_id' => session('login')]);
                DB::table('seat_runs')->where('seat_id', $seats_run_id->seat_id)->update(['flag' => 1]);
            }
        }
        return redirect('/main');
    }
    public function stuff(){
        return view('stuff');
    }
    public function cancelling(){
        return view('cancelling');
    }
    public function cancelling_post(Request $request){
        $code = $request->code;
        $password = $request->password;
        $login_id = session('login');
        $users = DB::table('customers')->where('id', $login_id)->first();
        if($users->password == $password) {
            $seat =  DB::table('tickets')->where('id', $code)->first();
            DB::table('seat_runs')->where('seat_id', $seat->seat_run_id)->update(['flag' => 0]);
            DB::table('tickets')->where('id', $code)->delete();
        }
        return redirect('/purchase');
    }
    public function schedule(){
        return view('schedule');
    }

    //
}
