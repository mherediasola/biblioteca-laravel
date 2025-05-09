<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function ejemplar()
    {
        return $this->belongsTo(Ejemplar::class, 'id_ejemplar');
    }
    
    static public function getPrestamos(){
        return self::select('prestamos.id', 
            DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellidos) as nombre'), 
            'usuarios.user_name as usuario',
            'usuarios.id as id_usuario', 
            'ejemplares.titulo as ejemplar',
            'ejemplares.id as id_ejemplar',
            'ejemplares.autor as autor',
            'prestamos.fecha_inicio as prestamo', 
            'prestamos.fecha_final as vencimiento')
            ->join('usuarios', 'usuarios.id', '=', 'prestamos.id_usuario')
            ->join('ejemplares', 'ejemplares.id', '=', 'prestamos.id_ejemplar')
            ->get();
    }

    static public function getPrestamo($id) {
        return self::select('prestamos.id', 
        DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellidos) as nombre'), 
        'usuarios.user_name as usuario', 
        'ejemplares.titulo as ejemplar', 
        'ejemplares.autor as autor',
        'prestamos.fecha_inicio as prestamo', 
        'prestamos.fecha_final as vencimiento')
        ->join('usuarios', 'usuarios.id', '=', 'prestamos.id_usuario')
        ->join('ejemplares', 'ejemplares.id', '=', 'prestamos.id_ejemplar')
        ->where('prestamos.id', '=', $id)
        ->get();
    }

    static public function getPrestamosUsuario($id) {
        return self::select('prestamos.id', 
        DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellidos) as nombre'), 
        'usuarios.user_name as usuario', 
        'ejemplares.titulo as ejemplar', 
        'ejemplares.autor as autor',
        'prestamos.fecha_inicio as prestamo', 
        'prestamos.fecha_final as vencimiento')
        ->join('usuarios', 'usuarios.id', '=', 'prestamos.id_usuario')
        ->join('ejemplares', 'ejemplares.id', '=', 'prestamos.id_ejemplar')
        ->where('usuarios.id', '=', $id)
        ->get();
    }

    static public function getLibroMasPrestado(){
        return self::select('ejemplares.titulo AS titulo',
        DB::raw('COUNT(prestamos.id_ejemplar) AS cantidad')) 
        ->join('ejemplares', 'ejemplares.id' ,'=', 'prestamos.id_ejemplar') 
        ->groupBy('prestamos.id_ejemplar', 'ejemplares.titulo')
        ->get();
    }
}