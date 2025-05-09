<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class SesionController extends Controller
{
    public function mostrar(){
        return view('/formularioIniciarSesion');
    }

    public function iniciarSesion(Request $request){
        $credenciales = $request->validate([
            'user_name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);
        
        if(Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            //de momento redirige a inicio, pero cuando pueda lo mandaré a la sección de cuenta
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function mostrarRegistro(){
        return view('/formularioRegistro');
    }

    public function registro(Request $request){
        $request->validate([
            'user_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'rePassword' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
        ]);

        if($request->password == $request->rePassword){
            $usuario = new Usuario();
            $usuario->id_rol = 3;
            $usuario->user_name = $request->user_name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email_verified_at = now();

            if(Usuario::where('user_name', $request->user_name)->first() != null) {
                return redirect('/formularioRegistro');
            }

            $usuario->save();

            return redirect('/');

        }else{
            return redirect('/formularioRegistro');
        }
        
    }


    public function cerrarSesion() {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }
}
