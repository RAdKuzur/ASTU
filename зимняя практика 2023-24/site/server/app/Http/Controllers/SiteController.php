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
    public function test(Request $request)
    {
        $data = DB::table('customers')->get();

        return response()->json(['message' => 'Пользователь создан', 'data' => $data]);
    }
    public function login(Request $request)
    {
        $login = $request->input('login');
        $users = DB::table('customers')->where('email', $login)->first();
        return response()->json(['data' => $users]);
    }
    public function profile(Request $request){
        $login_id = $request->input('login_id');
        $login_query = DB::table('customers')->where('id', $login_id)->first();
        $results = DB::table('tickets')
            ->join('seat_runs', 'tickets.seat_run_id', '=', 'seat_runs.id')
            ->join('runs', 'seat_runs.run_id', '=', 'runs.id')
            ->join('routes', 'runs.route_id', '=', 'routes.id')
            ->join('cities as departure_city', 'routes.departure_city_id', '=', 'departure_city.id')
            ->join('cities as arrival_city', 'routes.arrival_city_id', '=', 'arrival_city.id')
            ->join('seats', 'seat_runs.seat_id', '=', 'seats.id')
            ->join('buses', 'seats.bus_id', '=', 'buses.id')
            ->join('model_buses', 'buses.id', '=', 'model_buses.id')
            ->select('tickets.id', 'tickets.customer_id as id_customer' ,
                'runs.departure_time', "runs.arrival_time" , 'seats.number','seat_runs.customer_id',
                'seat_runs.price',
                'departure_city.name as departure_city_name', 'arrival_city.name as arrival_city_name', 'model_buses.brand' ,
                'model_buses.model', 'buses.number as reg_number')->get();
        $bookings = $results->where('id_customer',$login_id);
        return response()->json(['login_query' => $login_query, 'bookings' => $bookings]);
    }
    public function register_get(Request $request)
    {
        $login = $request->input('login');
        $users = DB::table('customers')->where('email', $login)->first();
        return response()->json(['users' => $users]);
    }
    public function register_post(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $serial = $request->input('serial');
        $number = $request->input('number');
        $login = $request->input('email');
        $password = $request->input('password');
        DB::table('customers')->insert(['email' => $login, 'password' => $password,
            'name' => $name, 'surname' => $surname, 'passport_series' => $serial,
            'passport_number' => $number, 'role' => 0]);
    }
    public function contacts_post(Request $request)
    {
        $login_id = $request->input('login_id');
        DB::table('comments')->insert(['comment' => $request->input('comment'), 'customer_id' => $login_id]);
    }
    public function booking()
    {
        $cities = DB::table('cities')->get();
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
        return response()->json(['cities' => $cities, 'runs_all' => $runs_all]);
    }
    public function booking_post(Request $request)
    {
        $departure_city = $request->input('dep');
        $arrive_city = $request->input('arr');
        $cities = DB::table('cities')->get();
        $route = DB::table('routes')->where('departure_city_id', $departure_city)
            ->where('arrival_city_id', $arrive_city)->first();
        if ($route != null) {
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
            $runs = DB::table('runs')->where('route_id', $route_id)->get();
        }
        return response()->json(['cities' => $cities, 'runs_all' => $runs_all, 'runs' => $runs]);
    }
    public function booking_id(Request $request)
    {
        $id = $request->input('id');
        $seats_all = DB::table('seats')
            ->join('seat_runs', 'seats.id', '=', 'seat_runs.seat_id')
            ->select('seats.*', 'seat_runs.*')
            ->get();
        $empty_seats = $seats_all->where('run_id', $id)->where('flag', 0);
        return response()->json(['empty_seats' => $empty_seats]);
    }
    public function booking_id_post(Request $request)
    {
        $id = $request->input('id');
        $login = $request->input('login');
        $seat = $request->input('seat');
        $seats_all = DB::table('seats')
            ->join('seat_runs', 'seats.id', '=', 'seat_runs.seat_id')
            ->select('seats.*', 'seat_runs.*')
            ->get();
        $empty_seats = $seats_all->where('run_id', $id)
            ->where('number', $seat)
            ->where('flag', 0)->first();
        DB::table('seat_runs')->where('id', $empty_seats->id)->update(['flag' => 1]);
        DB::table('tickets')->insert(['seat_run_id' => $empty_seats->id,
            'carrier_id' => 0,
            'customer_id' => $login,
            'code' => $login
        ]);
    }
    public function cancelling_post(Request $request)
    {
        $login_id = $request->input('login_id');
        $code = $request->input('code');
        $password = $request->input('password');
        $users = DB::table('customers')->where('id', $login_id)->first();
        $ticket = DB::table('tickets')->where('id', $code)->first();
        if($users->password == $password && $ticket != null) {
            if($ticket->customer_id == $login_id) {
                $seat = DB::table('tickets')->where('id', $code)->first();
                DB::table('seat_runs')->where('id', $seat->seat_run_id)->update(['flag' => 0]);
                DB::table('tickets')->where('id', $code)->delete();
            }
        }
    }
    public function schedule(Request $request){
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
        return response()->json(['runs' => $runs]);
    }
    public function run_auth(Request $request)
    {
        $login_id = $request->input('login_id');
        $query = DB::table('customers')->where('id', $login_id)->first();
        return response()->json(['query' => $query]);
    }
    public function run(Request $request)
    {
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
                'departure_cities.name as departure_city', 'arrival_cities.name as arrival_city', 'runs.id as run_id')
            ->get();
        $buses = DB::table('buses')
            ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
            ->select('buses.id', 'model_buses.brand', 'model_buses.model',
                'buses.number', 'buses.seats', 'buses.status')
            ->get();
        return response()->json(['routes' => $routes, 'carriers' => $carriers, 'runs' => $runs, 'buses' => $buses]);
    }
    public function other()
    {
        $routes = DB::table('routes')
            ->join('cities as departure_city', 'routes.departure_city_id', '=', 'departure_city.id')
            ->join('cities as arrival_city', 'routes.arrival_city_id', '=', 'arrival_city.id')
            ->select('routes.*', 'departure_city.name as departure_city_name', 'arrival_city.name as arrival_city_name')
            ->get();
        $cities = DB::table('cities')->get();
        $model_buses = DB::table('model_buses')->get();
        $carriers = DB::table('carriers')->get();
        $buses_all = DB::table('buses')
            ->join('model_buses', 'buses.model_id', '=', 'model_buses.id')
            ->select('model_buses.brand', 'model_buses.model', 'buses.number', 'buses.seats', 'buses.status')
            ->get();
        $customers = DB::table('customers')->get();
        return response()->json(['routes' => $routes, 'carriers' => $carriers,
                                 'cities' => $cities, 'model_buses' => $model_buses,
                                 'buses_all' => $buses_all, 'customers' => $customers
        ]);
    }
    public function comment()
    {
        $comments = DB::table('comments')
            ->join('customers', 'comments.customer_id', '=', 'customers.id')
            ->select('comments.*', 'customers.surname', 'customers.name', 'customers.email')
            ->get();
        return response()->json(['comments' => $comments]);
    }
    public function auto_run()
    {
        $tickets = DB::table('runs')->get();
        foreach ($tickets as $ticket) {
            $arr_time = strtotime($ticket->arrival_time);
            $dep_time = strtotime($ticket->departure_time);
            if($arr_time > time() && $dep_time < time()){
                DB::table('runs')->where('id', $ticket->id)->update(['status' => 1]);
            }
            if($arr_time < time() && $dep_time < time()){
                DB::table('runs')->where('id', $ticket->id)->update(['status' => 2]);
            }
            if($arr_time > time() && $dep_time > time()){
                DB::table('runs')->where('id', $ticket->id)->update(['status' => 0]);
            }
        }
    }
}
