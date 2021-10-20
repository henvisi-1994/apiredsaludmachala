<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class GestionPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $API_LOGIN_DEV     = "TPP3-EC-SERVER";
        $API_KEY_DEV       = "JdXTDl2d0o0B8ANZ1heJOq7tf62PC6";
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

    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index']);
    }
}
