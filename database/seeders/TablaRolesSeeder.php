<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'tipo' => 'Administrador'
        ]);

        DB::table('roles')->insert([
            'tipo' => 'Bibliotecario'
        ]);

        DB::table('roles')->insert([
            'tipo' => 'Estudiante'
        ]);
    }
}
