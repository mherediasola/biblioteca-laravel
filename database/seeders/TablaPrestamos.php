<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaPrestamos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestamos')->insert([
            'id_ejemplar' => '2',
            'id_usuario' => '3',
            'fecha_inicio' => '2024-11-26',
            'fecha_final' => '2024-12-03'
        ]);

        DB::table('prestamos')->insert([
            'id_ejemplar' => '3',
            'id_usuario' => '1',
            'fecha_inicio' => '2024-11-15',
            'fecha_final' => '2024-11-22'
        ]);

        DB::table('prestamos')->insert([
            'id_ejemplar' => '7',
            'id_usuario' => '6',
            'fecha_inicio' => '2024-11-20',
            'fecha_final' => '2024-11-27'
        ]);

        DB::table('prestamos')->insert([
            'id_ejemplar' => '8',
            'id_usuario' => '4',
            'fecha_inicio' => '2024-11-26',
            'fecha_final' => '2024-12-03'
        ]);
    }
}

