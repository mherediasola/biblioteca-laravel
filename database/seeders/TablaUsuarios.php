<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'id_rol' => '2',
            'user_name' => 'anamolrus',
            'email' => 'anamolrus@gmail.com',
            'password' => 'anamolrus123',
            'nombre' => 'Ana',
            'apellidos' => 'Moldovan Rus'
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '3',
            'user_name' => 'finioshav',
            'email' => 'finioshav@gmail.com',
            'password' => 'finioshav123',
            'nombre' => 'Fineas',
            'apellidos' => 'Iosif Havram'
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '3',
            'user_name' => 'nergomrui',
            'email' => 'nergomrui@gmail.com',
            'password' => 'nergomrui123',
            'nombre' => 'Nerea',
            'apellidos' => ' Gómez Ruiz'
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '2',
            'user_name' => 'vanjimlop',
            'email' => 'vanjimlop@gmail.com',
            'password' => 'vanjimlop123',
            'nombre' => 'Vanesa',
            'apellidos' => 'Jiménez López'
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '3',
            'user_name' => 'dieblasaa',
            'email' => 'dieblasaa@gmail.com',
            'password' => 'dieblasaa123',
            'nombre' => 'Diego',
            'apellidos' => 'Blanque Saavedra'
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '3',
            'user_name' => 'lucgarpeñ',
            'email' => 'lucgarpeñ@gmail.com',
            'password' => 'lucgarpeñ123',
            'nombre' => 'Lucas',
            'apellidos' => 'García Peña'
        ]);
    }
}

