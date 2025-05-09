<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejemplar;
use App\Models\Prestamo;

class ApiController extends Controller
{
    public function mostrarEjemplares(){
        $ejemplares = Ejemplar::all();

        return $ejemplares;
    }

    public function buscarEjemplar($id){
        $ejemplar = Ejemplar::where('id', $id)->first();

        return $ejemplar;
    }

    public function mostrarPrestamos(){
        $prestamos = Prestamo::getPrestamos();

        return $prestamos;
    }

    //muestra los préstamos según el id del préstamo
    public function buscarPrestamoId($id){
        $prestamo = Prestamo::getPrestamo($id);
        $prestamo = $prestamo->get(0);

        return $prestamo;
    }

    //muestra los préstamos según el id del usuario
    public function buscarPrestamoIdUsuario($id){
        $prestamos = Prestamo::getPrestamosUsuario($id);

        return $prestamos;
    }
}
