<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function mostrar(){
        $usuarios = Usuario::getUsuarios();
        $roles = Rol::all();
        
        return view('usuarios', ['usuarios' => $usuarios, 'roles' => $roles]);
    }

    public function listar(){
        $usuarios = Usuario::getUsuarios();

        return response()->json([
            'status' => 200,
            'usuarios' => $usuarios
        ]);
    }

    public function buscar($id){
        $usuario = Usuario::getUsuario($id);
        $usuario = $usuario->get(0);

        return view('buscarUsuarios', ['usuario' => $usuario]);
    }

    public function formularioInsertar(){
        $roles = Rol::all();
        return view('formularioUsuarios', ['roles' => $roles]);
    }

    public function insertar(Request $request){
        $request->validate([
            'rol' => ['required', 'integer'],
            'user_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
        ]);
        
        $usuario = new Usuario();
        //puedo obtener el id_rol del formulario porque el value del option es el id y no el tipo
        $usuario->id_rol = $request->rol;
        $usuario->user_name = $request->user_name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->save();

        // return redirect('/usuarios');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Usuario creado correctamente'
        ]);
    }

    public function mostrarEditar($id){
        $usuario = usuario::where('id', $id)->first();
        $roles = Rol::all();

        return view('formularioUsuariosEditar', [
            'usuario' => $usuario,
            'roles' => $roles
        ]);
    }

    public function editar(Request $request, $id){
        $usuario = Usuario::where('id', $id)->first();
        
        $request->validate([
            'rol' => ['required', 'integer'],
            'user_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
        ]);

        $usuario->id_rol = $request->rol;
        $usuario->user_name = $request->user_name;
        $usuario->email = $request->email;
        if($usuario->password != ($request->password)){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->save();

        //buscar el rol del usuario
        $rol = Rol::find($request->rol);
        // return redirect('/usuarios');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Usuario actualizado correctamente',
            'usuario' => [
                'id' => $usuario->id,
                'tipo' => $rol->tipo,
                'id_rol' => $rol->id,
                'user_name' => $usuario->user_name,
                'email' => $usuario->email,
                'password' => $usuario->password,
                'nombre' => $usuario->nombre,
                'apellidos' => $usuario->apellidos,
            ]
        ]);
    }

    public function eliminar($id){
        $usuario = Usuario::where('id', $id)->first();
        $usuario->delete();

        // return redirect('/usuarios');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Usuario borrado correctamente'
        ]);
    }
}
