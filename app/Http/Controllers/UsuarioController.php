<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;




class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = DB::select('select * from users');
        return $noticias;
    }
    public function obtener_usuario()
    {
        $usuario = User::paginate(5);
        return response()->json($usuario, 200);
    }
    public function buscar_usuario($busqueda){

        $usuario = User::where('name','like', '%' . $busqueda. '%')->orWhere('email','like', '%' . $busqueda. '%')->orWhere('telefono','like', '%' . $busqueda. '%')
        ->orWhere('identificacion',$busqueda)
        ->orWhere('direccion','like', '%' . $busqueda. '%')->paginate(10);
        return response()->json($usuario, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$v = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:10','min:9'],
            'identificacion' => ['required', 'string', 'max:13','min:10'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);*/
        // if ($v) {
        $usuario = User::where('email', $request->input('email'))->orWhere('identificacion', $request->input('identificacion'))->first();
        if ($usuario) {
            return response()->json(['Mensaje' => 'Email o Cédula Repetido'], 400);
        } else {
            $usuario = new User();
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');
            $usuario->telefono = $request->input('telefono');
            $usuario->identificacion = $request->input('identificacion');
            $usuario->direccion = $request->input('direccion');
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();
            $email=$usuario->email;
            $username=$usuario->name;
            $credenciales = [
                'email' => $email,
                'username' =>  $username,
                'id' => Crypt::encrypt($usuario->id)
            ];
            Mail::send('emailregistro', $credenciales, function ($msj) use ($email, $username) {
                $msj->to($email, $username);
                $msj->subject('Registro en Aplicacion Movil de Red de Salud Machala E.P');
            });
            return response()->json($usuario, 200);
        }


        //}
        /* else{
                return response()->json("Error al Guardar Registro", 400);
            }*/
    }
    public function validar_datos(Request $request){
        /*$v = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:10','min:9'],
            'identificacion' => ['required', 'string', 'max:13','min:10'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);*/

         //if ($v) {
            $usuario = User::where('email', $request->input('email'))->orWhere('identificacion', $request->input('identificacion'))->first();
            if ($usuario) {
                return response()->json(['mensaje' => 'Email o Cédula Repetido'], 40);
            }
            else{
                return response()->json(['mensaje' => 'Registro Correcto'], 200);

            }

         //}
              /*else{
                return response()->json(['mensaje'=>'Error al Guardar Registro'], 400);
            }*/

    }
    public function verificarCuenta($id){
        $id= Crypt::decrypt($id);
        $usuario = User::where('id', $id)->first();
        $usuario->email_verified_at=Carbon::now();
        $usuario->save();
        return view('verificarcuenta');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = ' ';
        $ruta = ' ';
        /*$v = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:10','min:9'],
            'identificacion' => ['required', 'string', 'max:13','min:10'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);*/
        // if ($v) {
        $usuario = User::where('id', $id)->first();
        $usuario = User::find($id)->firstOrFail();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->telefono = $request->input('telefono');
        $usuario->identificacion = $request->input('identificacion');
        $usuario->direccion = $request->input('direccion');
        $usuario->password = Hash::make($request->input('password'));
        //return $usuario;

        if ($request->input('password') != "") {
            DB::table('users')
                ->where('id', $id)
                ->update(
                    ['name' => $usuario->name, 'email' => $usuario->email, 'telefono' => $usuario->telefono, 'identificacion' => $usuario->identificacion, 'direccion' => $usuario->direccion, 'password' => $usuario->password]
                );
        } else {
            DB::table('users')
                ->where('id', $id)
                ->update(
                    ['name' => $usuario->name, 'email' => $usuario->email, 'telefono' => $usuario->telefono, 'identificacion' => $usuario->identificacion, 'direccion' => $usuario->direccion]
                );
        }

        //return response()->json($usuario, 200);
        return response()->json(['Mensaje' => 'Usuario actualizado con exito'], 200);


        /*} else {
            return response()->json("Error al Actualizar Registro", 400);
        }*/
    }

    public function update_perfil(Request $request)
    {
        $name = ' ';
        $ruta = ' ';
        /*$v = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:10','min:9'],
            'identificacion' => ['required', 'string', 'max:13','min:10'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);*/
        // if ($v) {
        $id = $request->input('id');
        $usuario = User::where('id', $id)->first();
        $usuario = User::find($id)->firstOrFail();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->telefono = $request->input('telefono');
        $usuario->identificacion = $request->input('identificacion');
        $usuario->direccion = $request->input('direccion');
        $usuario->password = Hash::make($request->input('password'));
        //return $usuario;
        $clave = $request->input('clave');
        if ($clave == "L@GH#h2zqG*B") {
            if ($request->input('password') != "") {
                DB::table('users')
                    ->where('id', $id)
                    ->update(
                        ['name' => $usuario->name, 'email' => $usuario->email, 'telefono' => $usuario->telefono, 'identificacion' => $usuario->identificacion, 'direccion' => $usuario->direccion, 'password' => $usuario->password]
                    );
            } else {
                DB::table('users')
                    ->where('id', $id)
                    ->update(
                        ['name' => $usuario->name, 'email' => $usuario->email, 'telefono' => $usuario->telefono, 'identificacion' => $usuario->identificacion, 'direccion' => $usuario->direccion]
                    );
            }
        }

        //return response()->json($usuario, 200);
        return response()->json(['Mensaje' => 'Usuario actualizado con exito'], 200);


        /*} else {
            return response()->json("Error al Actualizar Registro", 400);
        }*/
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita=Citas::where('id_usuario',$id)->get();
        if(count($cita)==0){
            $usuario = User::find($id);
            $usuario->delete();
        }
        else{
            return response()->json([
                'mensaje' => "Usuario tiene cita asignada"
            ],400);
        }
    }

    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index', 'store', 'update_perfil','validar_datos','verificarCuenta']);
    }
}
