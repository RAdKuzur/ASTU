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
class SiteController
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
        DB::table('tickets')->insert([
            'seat_run_id' => $empty_seats->id,
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
    public function other_post(Request $request)
    {
        $request_city = $request->input('request_city');
        $request_bus = $request->input('request_bus');
        $request_number = $request->input('request_number');
        $request_seats = $request->input('request_seats');
        $request_status =  $request->input('request_status');
        $request_carrier = $request->input('request_carrier');
        $request_city_1 = $request->input('request_city_1');
        $request_city_2 = $request->input('request_city_2');
        $request_user_email = $request->input('request_user_email');
        $request_user_password = $request->input('request_user_password');
        $request_name = $request->input('request_name');
        $request_surname = $request->input('request_surname');
        $request_serial = $request->input('request_serial');
        $request_number = $request->input('request_number');
        if($request_city != null && DB::table('cities')->where('name', $request_city)->first() == null) {
            DB::table('cities')->insert(['name' => $request_city]);
        }

        if($request_bus != null && $request_bus != 'Выберите автобус' && $request_number != null
            && $request_seats != null && $request_status != null && $request_status != 'Выберите статус') {
            if (DB::table('buses')->where('number', $request_number)->first() == null) {
                $bus_id = DB::table('buses')->insertGetId(['model_id' => $request_bus,
                    'number' => $request_number,
                    'seats' => $request_seats,
                    'status' => $request_status,
                ]);
                for ($i = 1; $i <= $request_seats; $i++) {
                    DB::table('seats')->insert(['bus_id' => $bus_id, 'number' => $i]);
                }
            }
        }
        if($request_carrier != null && DB::table('carriers')
                ->where('name', $request_carrier)->first() == null){
            DB::table('carriers')->insert(['name' => $request_carrier]);
        }
        if ($request_city_1 != null && $request_city_2 != null && $request_city_1 != $request_city_2
            && $request_city_1 != 'Выберите город отправления' && $request_city_2 != 'Выберите город прибытия'
        ){

            if(DB::table('routes')
                    ->where('departure_city_id', $request_city_1)
                    ->where('arrival_city_id', $request_city_2)->first() == null) {
                DB::table('routes')->insert(['departure_city_id' => $request_city_1,
                    'arrival_city_id' => $request_city_2]);
            }
        }
        if ($request_user_email != null && $request_user_password != null && $request_name != null
            && $request_surname != null && $request_serial != null && $request_number != null)
        {
            $name = $request_name;
            $surname = $request_surname;
            $serial = $request_serial;
            $number = $request_number;
            $login = $request_user_email;
            $password = $request_user_password;
            if(DB::table('customers')
                    ->where('email', $login)
                    ->first() == null) {
                DB::table('customers')->insert([
                    'email' => $login,
                    'password' => $password,
                    'name' => $name,
                    'surname' => $surname,
                    'passport_series' => $serial,
                    'passport_number' => $number,
                    'role' => 1
                ]);
            }
        }
    }
    public function run_post(Request $request)
    {
        $request_delete = $request->input('request_delete');
        $request_bus = $request->input('request_bus');
        $request_route = $request->input('request_route');
        $request_price = $request->input('request_price');
        $request_carrier = $request->input('request_carrier');
        $request_arr_time = $request->input('request_arr_time');
        $request_dep_time = $request->input('request_dep_time');
        $login_id = $request->input('login_id');

        if ($request_delete != null) {
            $tickets = DB::table('tickets')->get();
            foreach ($tickets as $ticket) {
                $ticket_id =  DB::table('seat_runs')->where('id', $ticket->seat_run_id)->first();
                if($ticket_id->run_id == $request_delete){
                    DB::table('tickets')->where('id',$ticket->id)->delete();
                }
            }
            DB::table('seat_runs')->where('run_id', $request_delete)->delete();
            DB::table('runs')->where('id', $request_delete)->delete();
        }

        $seat_bus = DB::table('buses')
            ->join('seats', 'buses.id', '=', 'seats.bus_id')
            ->select('buses.*', 'seats.*')
            ->get();
        $seat_bus = $seat_bus->where('bus_id', $request_bus)->first();

        if($seat_bus != null && $request_price != null &&  $request_carrier != 'Выберите перевозчика'
            && $request_route != 'Выберите маршрут' && $request_arr_time != null && $request_dep_time != null)
        {

            $seat_first_id = $seat_bus->id;
            $price = $request_price;
            $date_time_obj_arr = DateTime::createFromFormat('Y-m-d\TH:i', $request_arr_time);
            $date_time_obj_dep = DateTime::createFromFormat('Y-m-d\TH:i', $request_dep_time);
            $sql_date_arr = $date_time_obj_arr->format('Y-m-d H:i:s');
            $sql_date_dep = $date_time_obj_dep->format('Y-m-d H:i:s');
            if($sql_date_dep < $sql_date_arr) {
                $id = DB::table('runs')->insertGetId(['driver_id' => 1,
                    'bus_id' => $request_bus,
                    'status' => 0,
                    'route_id' => $request_route,
                    'carrier_id' => $request_carrier,
                    'departure_time' => $sql_date_dep,
                    'arrival_time' => $sql_date_arr
                ]);

                $seat = DB::table('buses')->where('id', $request_bus)->first('seats');
                for ($i = 1; $i <= $seat->seats; $i++) {
                    DB::table('seat_runs')->insert([
                        'seat_id' => $seat_first_id,
                        'run_id' => $id,
                        'customer_id' => $login_id,
                        'flag' => 0,
                        'price' => $price
                    ]);
                    $seat_first_id++;
                }

            }
        }
    }
}
