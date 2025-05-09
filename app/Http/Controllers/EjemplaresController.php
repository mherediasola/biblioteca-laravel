<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejemplar;
use App\Enums\Tipo;
use Illuminate\Validation\Rules\Enum;

class EjemplaresController extends Controller
{
    public function mostrar(){
        $ejemplares = Ejemplar::all();

        return view('ejemplares', ['ejemplares'=> $ejemplares, 'tipos' => Tipo::cases()]);

    }

    public function listar(){
        $ejemplares = Ejemplar::all();

        return response()->json([
            'status' => 200,
            'ejemplares' => $ejemplares
        ]);
    }

    public function buscar($id){
        $ejemplar = Ejemplar::where('id', $id)->first();

        return view('buscarEjemplares', ['ejemplar'=> $ejemplar]);
    }

    public function formularioInsertar(){
        
        return view('formularioEjemplares', ['tipos' => Tipo::cases()]);
    }

    public function insertar(Request $request){
        //para validar los datos que llegan del formulario
        $request->validate([
            'titulo' => ['required', 'string'],
            'autor' => ['required', 'string'],
            'tipo' => ['required', new Enum(Tipo::class)],
            'idioma' => ['required', 'string'],
            'editorial' => ['required', 'string'],
        ]);
        
        $ejemplar = new Ejemplar();
        $ejemplar->titulo = $request->titulo;
        $ejemplar->autor = $request->autor;
        $ejemplar->tipo = $request->tipo;
        $ejemplar->idioma = $request->idioma;
        $ejemplar->editorial = $request->editorial;
        $ejemplar->save();

        // return redirect('/ejemplares');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Ejemplar creado correctamente'
        ]);

    }

    public function mostrarEditar($id){
        $ejemplar = Ejemplar::where('id', $id)->first();

        return view('formularioEjemplaresEditar', [
            'ejemplar' => $ejemplar, 
            'tipos' => Tipo::cases()
        ]);
    }

    public function editar(Request $request, $id){
        $ejemplar = Ejemplar::where('id', $id)->first();

        $request->validate([
            'titulo' => ['required', 'string'],
            'autor' => ['required', 'string'],
            'tipo' => ['required', new Enum(Tipo::class)],
            'idioma' => ['required', 'string'],
            'editorial' => ['required', 'string'],
        ]);

        $ejemplar->titulo = $request->titulo;
        $ejemplar->autor = $request->autor;
        $ejemplar->tipo = $request->tipo;
        $ejemplar->idioma = $request->idioma;
        $ejemplar->editorial = $request->editorial;
        $ejemplar->save();

        // return redirect('/ejemplares');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Ejemplar actualizado correctamente',
            'ejemplar' => $ejemplar
        ]);
    }

    public function eliminar($id){
        $ejemplar = Ejemplar::where('id', $id)->first();
        $ejemplar->delete();

        // return redirect('/ejemplares');
        return response()->json([
            'status' => 200,
            'mensaje' => 'Ejemplar borrado correctamente'
        ]);
    }
}
