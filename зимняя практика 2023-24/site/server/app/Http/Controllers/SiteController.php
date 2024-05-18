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
}
