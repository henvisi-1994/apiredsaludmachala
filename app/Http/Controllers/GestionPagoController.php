<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;




class GestionPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentez = Config::get('paymentez');
        $API_LOGIN_DEV=$paymentez['api_login_dev'];
        $API_KEY_DEV=$paymentez['api_key_dev'];
        $server_application_code = $API_LOGIN_DEV;
        $server_app_key = $API_KEY_DEV;
        $unix_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328
        // $unix_timestamp = "1546543146";
        $uniq_token_string = $server_app_key.$unix_timestamp;
        $uniq_token_hash = hash('sha256', $uniq_token_string);
        // $uniq_token_hash = "14e1c1dc9109839923de0e00a7915fe3fa9300b481973d9e874f76fcf11856e1";

        $auth_token = base64_encode($server_application_code . ";" . $unix_timestamp . ";" . $uniq_token_hash);
        return response()->json([
            'authtoken' => $auth_token
        ]);

        /*14e1c1dc9109839923de0e00a7915fe3fa9300b481973d9e874f76fcf11856e1
        'TIMESTAMP' => $unix_timestamp,
        'UNIQTOKENST' => $uniq_token_string,
        'UNIQTOHAS' => $uniq_token_hash,*/
    }
    public function obtener_tarjeta($identificacion){
        $url="https://ccapi-stg.paymentez.com/v2/card/list?uid=".$identificacion;
        $API_LOGIN_DEV     = env('API_LOGIN_DEV', null);
        $API_KEY_DEV       = env('API_KEY_DEV', null);
        $server_application_code = $API_LOGIN_DEV;
        $server_app_key = $API_KEY_DEV;
        $unix_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328
        // $unix_timestamp = "1546543146";
        $uniq_token_string = $server_app_key.$unix_timestamp;
        $uniq_token_hash = hash('sha256', $uniq_token_string);
        // $uniq_token_hash = "14e1c1dc9109839923de0e00a7915fe3fa9300b481973d9e874f76fcf11856e1";

        $auth_token = base64_encode($server_application_code . ";" . $unix_timestamp . ";" . $uniq_token_hash);
        $response = Http::withHeaders([
            'Auth-Token' => $auth_token
        ])->get($url);
        $area = json_decode($response, true);
        return $area['cards'];

    }

    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','obtener_tarjeta','status']);
    }
    public function status(Request $request){
        $status ='Ha realizado el pago correctamente';
        return $status;

    }
}
