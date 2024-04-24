<?php
namespace App\Http\Controllers;
use App\Models\User;
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
        $results = DB::table('seats')
            ->join('seat_runs', 'seats.id', '=', 'seat_runs.seat_id')
            ->join('tickets', 'seat_runs.id', '=', 'tickets.seat_run_id')
            ->select('seats.*', 'seat_runs.*', 'tickets.*')
            ->get();

        $bookings = $results->where('customer_id',$login_id);
        return view('profile')->with(['login_query'=>$login_query, 'bookings' => $bookings]);
    }
    public function profile_post(){
        session(['key' => null, 'login' => null]);
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
        $users = DB::table('customers')->where('email', $login)->first();
        if ($users == null){
            DB::table('customers')->insert(['email' => $login, 'password' => $password,
                'name' => $name, 'surname' => $surname, 'passport_series' => $serial,
                'passport_number' => $number, 'role' => 0]);
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
        $login_id = session('login');
        if($login_id != null) {
            if ($request->comment) {
                DB::table('comments')->insert(['comment' => $request->comment, 'customer_id' => $login_id]);
            }
            return redirect('/main');
        }
        else {
            return redirect('/login');
        }
    }
    public function purchase(){
        return view('purchase');
    }
    public function booking(){
                $cities = DB::table('cities')->get();
                $runs = null;
                $runs_all = DB::table('runs')
                    ->join('routes', 'runs.route_id', '=', 'routes.id')
                    ->join('buses', 'runs.bus_id', '=', 'buses.id')
                    ->join('carriers', 'runs.carrier_id', '=', 'carriers.id')
                    ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
                    ->join('cities as departure_cities', 'routes.departure_city_id', '=', 'departure_cities.id')
                    ->join('cities as arrival_cities', 'routes.arrival_city_id', '=', 'arrival_cities.id')
                    ->select('runs.*', 'routes.*', 'buses.number', 'carriers.*', 'model_buses.*',
                        'departure_cities.name as departure_city', 'arrival_cities.name as arrival_city')
                    ->get();
                return view('booking')->with([
                    'cities' => $cities,
                    'runs_all' => $runs_all,
                    'runs' => $runs
                ]);
    }
    public function booking_post(Request $request){
        $cities = DB::table('cities')->get();
        $departure_city = $request->city_1;
        $arrive_city = $request->city_2;
        $route = DB::table('routes')->where('departure_city_id',$departure_city)
            ->where('arrival_city_id', $arrive_city)->first();
        if($route != null) {
            $route_id = $route->id;
            $runs_all = DB::table('runs')
                ->join('routes', 'runs.route_id', '=', 'routes.id')
                ->join('buses', 'runs.bus_id', '=', 'buses.id')
                ->join('carriers', 'runs.carrier_id', '=', 'carriers.id')
                ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
                ->join('cities as departure_cities', 'routes.departure_city_id', '=', 'departure_cities.id')
                ->join('cities as arrival_cities', 'routes.arrival_city_id', '=', 'arrival_cities.id')
                ->select('runs.*', 'routes.*', 'buses.number', 'carriers.*', 'model_buses.*',
                    'departure_cities.name as departure_city', 'arrival_cities.name as arrival_city')
                ->get();
            $runs = DB::table('runs') -> where('route_id', $route_id)->get();
            return view('booking')->with(['runs' => $runs, 'cities'=>$cities, 'runs_all' => $runs_all]);
        }
        else {
            return redirect('/purchase/booking');
        }
    }
    public function booking_id($id){
        $seats_all = DB::table('seats')
            ->join('seat_runs', 'seats.id', '=', 'seat_runs.seat_id')
            ->select('seats.*', 'seat_runs.*')
            ->get();

        $empty_seats = $seats_all->where('run_id', $id)->where('flag' , 0);
        return view('bookingId')->with(['id' => $id, 'empty_seats' => $empty_seats]);
    }
    public function booking_id_post(Request $request, $id){
        $seats_all = DB::table('seats')
            ->join('seat_runs', 'seats.id', '=', 'seat_runs.seat_id')
            ->select('seats.*', 'seat_runs.*')
            ->get();

        $empty_seats = $seats_all->where('run_id', $id)
            ->where('number', $request->seat)
            ->where('flag' , 0)->first();

        //dd($empty_seats);
        DB::table('seat_runs')->where('id', $empty_seats->id)->update(['flag' => 1]);
        DB::table('tickets')->insert(['seat_run_id'=> $empty_seats->id,
            'carrier_id' => 0,
            'customer_id' => session('login'),
            'code' => session('login')
        ]);
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
        $runs = DB::table('runs')
            ->join('routes', 'runs.route_id', '=', 'routes.id')
            ->join('buses', 'runs.bus_id', '=', 'buses.id')
            ->join('carriers', 'runs.carrier_id', '=', 'carriers.id')
            ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
            ->join('cities as departure_cities', 'routes.departure_city_id', '=', 'departure_cities.id')
            ->join('cities as arrival_cities', 'routes.arrival_city_id', '=', 'arrival_cities.id')
            ->select('runs.*', 'routes.*', 'buses.number', 'carriers.*', 'model_buses.*',
                'departure_cities.name as departure_city', 'arrival_cities.name as arrival_city')
            ->get();
        return view('schedule')->with(['runs' => $runs]);
    }
    public function run()
    {

        $login_id = session('login');
        $query = DB::table('customers')->where('id', $login_id)->first();
        if($query->role != 0){
            $routes = DB::table('routes')
                ->join('cities as departure', DB::raw('CAST(routes.departure_city_id AS bigint)'), '=', 'departure.id')
                ->join('cities as arrival', DB::raw('CAST(routes.arrival_city_id AS bigint)'), '=', 'arrival.id')
                ->select('routes.*', 'departure.name as departure_city', 'arrival.name as arrival_city')
                ->get();
            $carriers = DB::table('carriers')->get();
            $runs = DB::table('runs')
                ->join('routes', 'runs.route_id', '=', 'routes.id')
                ->join('buses', 'runs.bus_id', '=', 'buses.id')
                ->join('carriers', 'runs.carrier_id', '=', 'carriers.id')
                ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
                ->join('cities as departure_cities', 'routes.departure_city_id', '=', 'departure_cities.id')
                ->join('cities as arrival_cities', 'routes.arrival_city_id', '=', 'arrival_cities.id')
                ->select('runs.*', 'routes.*', 'buses.number', 'carriers.*', 'model_buses.*',
                    'departure_cities.name as departure_city', 'arrival_cities.name as arrival_city')
                ->get();
            $buses = DB::table('buses')
                ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
                ->select('buses.id','model_buses.brand', 'model_buses.model',
                    'buses.number', 'buses.seats', 'buses.status')
                ->get();
              return view('run')->with([
                  'carriers' => $carriers,
                  'buses' => $buses,
                  'routes' => $routes,
                  'runs' => $runs
            ]);
        }
        else {
            return redirect('/main');
        }
    }
    public function run_post(Request $request){
        $seat_bus =  DB::table('buses')
            ->join('seats', 'buses.id', '=', 'seats.bus_id')
            ->select('buses.*', 'seats.*')
            ->get();
        $seat_bus = $seat_bus->where('bus_id', $request->bus)->first();
        $seat_first_id = $seat_bus->id;
        $price = $request->price;
        $date_time_obj_arr = DateTime::createFromFormat('Y-m-d\TH:i', $request->dep_time);
        $date_time_obj_dep = DateTime::createFromFormat('Y-m-d\TH:i', $request->arr_time);
        $sql_date_arr = $date_time_obj_arr->format('Y-m-d H:i:s');
        $sql_date_dep = $date_time_obj_dep->format('Y-m-d H:i:s');
        $id = DB::table('runs')->insertGetId(['driver_id' => 1,
            'bus_id' => $request->bus,
            'status' => 0,
            'route_id' => $request->route,
            'carrier_id' => $request->carrier,
            'departure_time' => $date_time_obj_dep,
            'arrival_time' => $date_time_obj_arr
        ]);

        $seat = DB::table('buses')->where('id',$request->bus)->first('seats');
        for($i = 1; $i <= $seat->seats; $i++){
            DB::table('seat_runs')->insert([
                 'seat_id' => $seat_first_id,
                 'run_id' => $id,
                 'customer_id' => session('login'),
                 'flag' => 0,
                 'price' => $price
            ]);
            $seat_first_id++;
        }
        return redirect('/stuff/run');
        return redirect('/stuff/run');
    }
    public function other(){
        $first_counter = 1;
        $second_counter = 1;
        $third_counter = 1;
        $routes = DB::table('routes')
            ->join('cities as departure_city', 'routes.departure_city_id', '=', 'departure_city.id')
            ->join('cities as arrival_city', 'routes.arrival_city_id', '=', 'arrival_city.id')
            ->select('routes.*', 'departure_city.name as departure_city_name', 'arrival_city.name as arrival_city_name')
            ->get();
        $cities = DB::table('cities')->get();
        $model_buses =  DB::table('model_buses')->get();
        $carriers = DB::table('carriers')->get();
        $buses_all = DB::table('buses')
            ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
            ->select('model_buses.brand', 'model_buses.model', 'buses.number', 'buses.seats', 'buses.status')
            ->get();

        return view("other")->with(['cities' => $cities, 'first_counter' => $first_counter,
            'buses' => $buses_all, 'second_counter' => $second_counter,
            'model_buses' => $model_buses,
            'carriers' => $carriers, 'third_counter' => $third_counter,
            'routes' => $routes

        ]);
    }
    public function other_post(Request $request){
        if($request->city != null && DB::table('cities')->where('name', $request->city)->first() == null){
            DB::table('cities')->insert(['name' => $request->city]);
        }
        if($request->bus != null && $request->number != null && $request->seats != null && $request->status != null){
            $bus_id = DB::table('buses')->insertGetId(['model_id' => $request->bus,
                'number' => $request->number,
                'seats' => $request->seats,
                'status' => $request->status,
                ]);
            for($i = 1; $i<= $request->seats; $i++){
                DB::table('seats')->insert(['bus_id' => $bus_id, 'number' => $i]);
            }
        }
        if($request->carrier != null && DB::table('carriers')
                ->where('name', $request->carrier)->first() == null){
            DB::table('carriers')->insert(['name' => $request->carrier]);
        }
        if ($request->city_1 != null && $request->city_2 != null && $request->city_1 != $request->city_2){
            DB::table('routes')->insert(['departure_city_id' => $request->city_1,
                'arrival_city_id' => $request->city_2]);
        }
        return redirect('/stuff/other');
    }
}
