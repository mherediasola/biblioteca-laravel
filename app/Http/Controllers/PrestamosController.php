<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Usuario;
use App\Models\Ejemplar;
use Illuminate\Support\Facades\Auth;

class PrestamosController extends Controller
{
    public function mostrar(){
        $prestamos = Prestamo::getPrestamos();
        $usuarios = Usuario::all();
        $ejemplares = Ejemplar::all();

        return view('prestamos', [
            'prestamos' => $prestamos,
            'usuarios' => $usuarios,
            'ejemplares' => $ejemplares,
        ]);

    }

    public function listar(){
        $prestamos = Prestamo::getPrestamos();

        return response()->json([
            'status' => 200,
            'prestamos' => $prestamos
        ]);
    }

    public function buscarPrestamoId($id){
        $prestamo = Prestamo::getPrestamo($id);
        $prestamo = $prestamo->get(0);

        return view('buscarPrestamos', ['prestamo' => $prestamo]);
    }

    //muestra los prestamos según el id del usuario
    public function buscarPrestamoIdUsuario($id){
        $prestamos = Prestamo::getPrestamosUsuario($id);
        return view('prestamoPorUsuario', ['prestamos' => $prestamos]);
    }

    public function mostrarMisPrestamos(){
        if(Auth::user()){
            $usuarioId = Auth::user()->id;
            $prestamos = Prestamo::getPrestamosUsuario($usuarioId);
            return view('misPrestamos', ['prestamos' => $prestamos]);
        }
    }

    public function formularioInsertar(){
        $usuarios = Usuario::all();
        $ejemplares = Ejemplar::all();
        return view('formularioPrestamos', 
            ['usuarios' => $usuarios,
            'ejemplares' => $ejemplares
        ]);
    }

    public function insertar(Request $request){
        $request->validate([
            'ejemplar' => ['required', 'integer'],
            'usuario' => ['required', 'integer'],
            'prestamo' => ['required', 'string'],
            'vencimiento' => ['required', 'string']
        ]);
        
        $prestamo = new Prestamo();
        //puedo obtener el id_rol del formulario porque el value del option es el id y no el tipo
        $prestamo->id_ejemplar = $request->ejemplar;
        $prestamo->id_usuario = $request->usuario;
        $prestamo->fecha_inicio = $request->prestamo;
        $prestamo->fecha_final = $request->vencimiento;
        $prestamo->save();

        // return redirect('/prestamos');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Préstamo creado correctamente'
        ]);
    }

    public function mostrarEditar($id){
        $prestamo = Prestamo::where('id', $id)->first();
        $usuarios = Usuario::all();
        $ejemplares = Ejemplar::all();

        return view('formularioPrestamosEditar', [
            'prestamo' => $prestamo,
            'usuarios' => $usuarios,
            'ejemplares' => $ejemplares
        ]);

    }

    public function editar(Request $request, $id){
        $prestamo = Prestamo::where('id', $id)->first();

        $request->validate([
            'ejemplar' => ['required', 'integer'],
            'usuario' => ['required', 'integer'],
            'prestamo' => ['required', 'string'],
            'vencimiento' => ['required', 'string']
        ]);

        $prestamo->id_ejemplar = $request->ejemplar;
        $prestamo->id_usuario = $request->usuario;
        $prestamo->fecha_inicio = $request->prestamo;
        $prestamo->fecha_final = $request->vencimiento;
        $prestamo->save();

        // return redirect('/prestamos');

        //buscar el rol del usuario
        $ejemplar = Ejemplar::find($request->ejemplar);
        $usuario = Usuario::find($request->usuario);
        // return redirect('/usuarios');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Usuario actualizado correctamente',
            'prestamo' => [
                'id' => $prestamo->id,
                'usuario' => $usuario->user_name,
                'nombre' => $usuario->nombre." ".$usuario->apellidos,
                'ejemplar' => $ejemplar->titulo,
                'autor' => $ejemplar->autor,
                'prestamo' => $prestamo->fecha_inicio,
                'vencimiento' => $prestamo->fecha_final,
            ]
        ]);
    }

    public function eliminar($id){
        $prestamo = Prestamo::where('id', $id)->first();
        $prestamo->delete();

        // return redirect('/prestamos');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Préstamo borrado correctamente'
        ]);
    }

    public function dashboard(){
        //MODIFICAR CONSULTA
        $datos = Prestamo::getLibroMasPrestado();

        return view('dashboard', [
            'datos' => $datos->toArray()
        ]);
    }
}
