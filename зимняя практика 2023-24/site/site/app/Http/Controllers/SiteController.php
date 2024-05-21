<?php
namespace App\Http\Controllers;
use App\Models\User;
use Exception;
use Redirect;
use DateTime;
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
    public function test()
    {
        $client = new Client();
        $response = $client->request('GET', '127.0.0.1:8001/api/test');

        $data = json_decode($response->getBody(), true);
        dd($data['data']);
    }
    public function auto_run()
    {
        // функция автоматического изменения статуса рейсов
        $client = new Client();
        $response = $client->request('GET', '127.0.0.1:8001/api/auto');
    }
    public function login_show(){
        return view('login');
    }
    public function login_post(Request $request){
        $client = new Client();
        $login = $request->email;
        $password = $request->password;
        $response = $client->request('POST', '127.0.0.1:8001/api/login', [
            'json' => [
                'login' => $login,
                'password' => $password
            ]
        ]);
        $users = json_decode($response->getBody(), true);
        $users = $users['data'];
        if ($users == null){
            return redirect('/login');
        }
        if($users['password'] == $password) {
            if($users['role'] == 0) {
                session(['key' => 'auth', 'login' => $users['id'], 'role' => 0]);
            }
            else {
                session(['key' => 'auth', 'login' => $users['id'], 'role' => 1]);
            }
            return redirect('/main');
        }
        else {
            return redirect('/login');
        }
    }
    public function profile(){
        $client = new Client();
        $login_id = session('login');
        $response = $client->request('GET', '127.0.0.1:8001/api/profile', [
            'json' => [
                'login_id' => $login_id
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $login_query = $data['login_query'];
        $bookings = $data['bookings'];
        if($login_query != null) {
            return view('profile')->with(['login_query' => $login_query, 'bookings' => $bookings]);
        }
        else {
            session(['key' => null, 'login' => null, 'role' => null]);
            return redirect('/login');
        }
    }
    public function profile_post(){
        session(['key' => null, 'login' => null, 'role' => null]);
        return redirect('/login');
    }
    public function register_show(){
        return view('register');
    }
    public function register_post(Request $request){
        $name = $request->name;
        $surname = $request->surname;
        $serial = $request->serial;
        $number = $request->number;
        $login = $request->email;
        $password = $request->password;
        $client = new Client();
        $response = $client->request('GET', '127.0.0.1:8001/api/register_get', [
            'json' => [
                'login' => $login
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $users = $data['users'];

        if ($users == null){
            $response = $client->request('POST', '127.0.0.1:8001/api/register_post', [
                'json' => [
                    'email' => $login,
                    'password' => $password,
                    'name' => $name,
                    'surname' => $surname,
                    'serial' => $serial,
                    'number' => $number
                ]
            ]);
            return redirect('/login');
        }
        return redirect('/register');
    }
    public function main_show(){
        return view('main');
    }
    public function contacts(){
        return view('contacts');
    }
    public function contacts_post(Request $request){
        $login_id = session('login');
        if($login_id != null) {
            if ($request->comment) {
                $client = new Client();
                $response = $client->request('POST', '127.0.0.1:8001/api/contacts_post', [
                    'json' => [
                        'login_id' => $login_id,
                        'comment' => $request->comment
                    ]
                ]);
            }
            return redirect('/contacts');
        }
        else {
            return redirect('/login');
        }
    }
    public function purchase(){
        return view('purchase');
    }
    public function booking(){
        $this->auto_run();
        if (session('login') != null) {
            $runs = null;
            $client = new Client();
            $response = $client->request('GET', '127.0.0.1:8001/api/booking');
            $data = json_decode($response->getBody(), true);

            $cities = $data['cities'];
            $runs_all = $data['runs_all'];
            return view('booking')->with([
                'cities' => $cities,
                'runs_all' => $runs_all,
                'runs' => $runs
            ]);
        }
        else {
            return redirect('/login');
        }
    }
    public function booking_post(Request $request){
        if(session('login') != null) {
            $departure_city = $request->city_1;
            $arrival_city = $request->city_2;
            if($departure_city == 'Выберите город отправления'
                || $arrival_city == 'Выберите город назначения') {
                return redirect('/purchase/booking');
            }
            $client = new Client();
            $response = $client->request('POST', '127.0.0.1:8001/api/booking', [
                'json' => [
                    'dep' => $departure_city,
                    'arr' => $arrival_city
                ]
            ]);
            $data = json_decode($response->getBody(), true);
            $runs = $data['runs'];
            $cities = $data['cities'];
            $runs_all = $data['runs_all'];
            return view('booking')->with(['runs' => $runs, 'cities' => $cities, 'runs_all' => $runs_all]);
        }
        else {
            return redirect('/login');
        }

    }
    public function booking_id($id)
    {
        if (session('login') != null) {
            $client = new Client();
            $response = $client->request('GET', '127.0.0.1:8001/api/booking_id', [
                'json' => [
                    'id' => $id
                ]
            ]);
            $data = json_decode($response->getBody(), true);
            $empty_seats = $data['empty_seats'];
            return view('bookingId')->with(['id' => $id, 'empty_seats' => $empty_seats]);
        }
        else {
            return redirect('/login');
        }
    }
    public function booking_id_post(Request $request, $id)
    {
        if (session('login') != null) {
            $client = new Client();
            $response = $client->request('POST', '127.0.0.1:8001/api/booking_id_post', [
                'json' => [
                    'id' => $id,
                    'login' => session('login'),
                    'seat' => $request->seat
                ]
            ]);
            return redirect('/purchase/booking');
        }
        else {
            return redirect('/login');
        }
    }
    public function stuff(){
        if(session('login') != null && session('role') == 1) {
            return view('stuff');
        }
        else {
            return redirect('/login');
        }
    }
    public function cancelling(){
        if(session('login') != null) {
            return view('cancelling');
        }
        else {
            return redirect('/login');
        }
    }
    public function cancelling_post(Request $request){
        $code = $request->code;
        $password = $request->password;
        if (!(is_numeric($code) && (int)$code == $code)) {
           return redirect('/purchase');
        }
        $login_id = session('login');
        $client = new Client();
        $response = $client->request('POST', '127.0.0.1:8001/api/cancelling_post', [
            'json' => [
                'login_id' => $login_id,
                'code' => $code,
                'password' => $password
            ]
        ]);
        return redirect('/purchase/cancelling');
    }
    public function schedule(){
        $this->auto_run();
        $client = new Client();
        $response = $client->request('GET', '127.0.0.1:8001/api/schedule');
        $data = json_decode($response->getBody(), true);
        $runs = $data['runs'];
        return view('schedule')->with(['runs' => $runs]);
    }
    public function run()
    {
        $this->auto_run();
        if(session('login')!=null  && session('role') == 1) {
            $login_id = session('login');
            $client = new Client();
            $response = $client->request('GET', '127.0.0.1:8001/api/run_auth', [
                    'json' => [
                        'login_id' => $login_id,
                    ]
                ]
            );
            $data = json_decode($response->getBody(), true);
            $query = $data['query'];
            if ($query['role'] != 0) {
                $response = $client->request('GET', '127.0.0.1:8001/api/run');
                $data = json_decode($response->getBody(), true);
                $runs = $data['runs'];
                $carriers = $data['carriers'];
                $buses = $data['buses'];
                $routes = $data['routes'];
                return view('run')->with([
                    'carriers' => $carriers,
                    'buses' => $buses,
                    'routes' => $routes,
                    'runs' => $runs
                ]);
            } else {
                return redirect('/main');
            }
        }
        else {
            return redirect('/login');
        }
    }
    public function run_post(Request $request){
        $client = new Client();
        $response = $client->request('POST', '127.0.0.1:8001/api/run_post', [
            'json' => [
                'request_delete' => $request->delete,
                'request_bus' => $request->bus,
                'request_route' => $request->route,
                'request_price' => $request->price,
                'request_carrier' => $request->carrier,
                'request_arr_time' => $request->arr_time,
                'request_dep_time'=> $request->dep_time,
                'login_id' => session('login')
            ]
        ]);

        return redirect('/stuff/run');
    }
    public function other()
    {
        if (session('login')!=null  && session('role') == 1) {
            $first_counter = 1;
            $second_counter = 1;
            $third_counter = 1;
            $fourth_counter = 1;
            $client = new Client();
            $response = $client->request('GET', '127.0.0.1:8001/api/other');
            $data = json_decode($response->getBody(), true);
            $cities = $data['cities'];
            $buses_all = $data['buses_all'];
            $model_buses = $data['model_buses'];
            $carriers = $data['carriers'];
            $routes = $data['routes'];
            $customers = $data['customers'];
            return view("other")->with([
                'cities' => $cities, 'first_counter' => $first_counter,
                'buses' => $buses_all, 'second_counter' => $second_counter,
                'model_buses' => $model_buses,
                'carriers' => $carriers, 'third_counter' => $third_counter,
                'routes' => $routes,
                'customers' => $customers, 'fourth_counter' => $fourth_counter
            ]);
        }
        else {
            return redirect('/login');
        }
    }
    public function other_post(Request $request){
        $client = new Client();
        $response = $client->request('POST', '127.0.0.1:8001/api/other', [
            'json' => [
                'request_city' => $request->city,
                'request_bus' => $request->bus,
                'request_number' => $request->number,
                'request_seats' => $request->seats,
                'request_status' => $request->status,
                'request_carrier' => $request->carrier,
                'request_city_1' => $request->city_1,
                'request_city_2'=> $request->city_2,
                'request_user_email' => $request->user_email,
                'request_user_password' => $request->user_password,
                'request_name' => $request->name,
                'request_surname' => $request->surname,
                'request_serial' => $request->serial,
                'request_number' => $request->number
            ]
        ]);
        return redirect('/stuff/other');
    }
    public function comment()
    {
        $counter = 1;
        $client = new Client();
        $response = $client->request('GET', '127.0.0.1:8001/api/comment');
        $data = json_decode($response->getBody(), true);
        $comments = $data['comments'];
        return view('comment')->with(['comments' => $comments, 'counter' => $counter]);
    }
}
