<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolesController extends Controller
{
    public function mostrar(){
        $roles = Rol::all();

        return view('roles', ['roles'=> $roles]);
    }

    public function listar(){
        $roles = Rol::all();

        return response()->json([
            'status' => 200,
            'roles' => $roles
        ]);
    }

    public function buscar($id){
        $rol = Rol::where('id', $id)->first();

        return view('buscarRoles', ['rol'=> $rol]);
    }

    public function insertar(Request $request){
        //para validar los datos que llegan del formulario
        $request->validate([
            'tipo' => ['required', 'string']
        ]);
        
        $rol = new Rol();
        $rol->tipo = $request->tipo;
        $rol->save();

        // return redirect('/roles');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Rol creado correctamente'
        ]);

    }

    public function formularioInsertar(){
        return view('formularioRoles');
    }

    public function mostrarEditar($id){
        $rol = Rol::where('id', $id)->first();

        return view('formularioRolesEditar', [
            'rol' => $rol
        ]);
    }

    public function editar(Request $request, $id){
        $request->validate([
            'tipo' => ['required', 'string']
        ]);

        $rol = Rol::where('id', $id)->first();
        $rol->tipo = $request->tipo;
        $rol->save();

        // return redirect('/roles');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Rol actualizado correctamente',
            'rol' => $rol
        ]);
    }

    public function eliminar($id){
        $rol = Rol::where('id', $id)->first();
        $rol->delete();

        // return redirect('/roles');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Rol borrado correctamente'
        ]);
    }
}
