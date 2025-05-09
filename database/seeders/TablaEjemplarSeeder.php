<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaEjemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ejemplares')->insert([
            'titulo' => 'El gran Gatsby',
            'autor' => 'F. Scott Fitzgerald',
            'tipo' => 'libro',
            'idioma' => 'Español',
            'editorial' => 'Cátedra'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'El gran Gatsby',
            'autor' => 'F. Scott Fitzgerald',
            'tipo' => 'libro',
            'idioma' => 'Inglés',
            'editorial' => 'Penguin'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'Cien Años de soledad',
            'autor' => 'Gabriel García Márquez',
            'tipo' => 'libro',
            'idioma' => 'Español',
            'editorial' => 'RAE'
        ]);

        
    }
}
