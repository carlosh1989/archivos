<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Councilor;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCuenta;
use App\Post;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Councilor::all();
        return view('admin.cuentas.all', compact('resultados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCuenta $request)
    {
        $archivo = $request->file('archivo');
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role = $request->role;
        $cedula = $request->cedula;
        $telefono = $request->telefono;
        $comision = $request->comision;
        $direccion = $request->direccion;
        $parroquia = $request->parroquia;
        $nacimiento = $request->nacimiento;

        //Guadar login
        $user = User::create([
            'councilor_id' => '0',
            'email' => $email,
            'password' => $password,
            'role'=> $role,
        ]);

        //modificando el enlace al archivo para que solo quede el url
        $subida = $request->file('archivo')->store('public');
        list($public, $avatar) = explode('/', $subida);

        //crear la tabla de datos de concejales
        $datos = Councilor::create([
            'user_id' => $user->id,
            'avatar' => $avatar,
            'name' => $name,
            'cedula' => $cedula,
            'telefono' => $telefono,
            'comision' => $comision,
            'direccion' => $direccion,
            'parroquia' => $parroquia,
            'nacimiento' => $nacimiento,
        ]);

        $room = Room::create([
            'councilor_id' => $datos->id,
            'siteID' => '',
        ]);

        $user->councilor_id = $datos->id;
        $user->save();

        Alert::success(''.ucfirst($role).' agregado con exito')->autoclose(3000);
        return Redirect::to('/admin/cuentas/create');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $concejal = Councilor::find($usuario->councilor_id);
            $room = Room::where('councilor_id', $concejal->id)->delete();
            $posts = Post::where('councilor_id', $concejal->id)->delete();
            $concejal->delete();
            $usuario->delete();
            Alert::success('Usuario eliminado con exito!')->autoclose(3000);
            return Redirect::to('/admin/cuentas');
        } else {
            Alert::warning('Ese usuario no esta en el sistema!')->autoclose(3000);
            return Redirect::to('/admin/cuentas');
        }
    }
}
