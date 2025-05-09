<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaEjemplaresAñadir extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ejemplares')->insert([
            'titulo' => 'Los libros de Terramar',
            'autor' => 'Ursula K. Le Guin',
            'tipo' => 'libro',
            'idioma' => 'Español',
            'editorial' => 'Minotauro'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'En busca del tiempo perdido',
            'autor' => 'Proust',
            'tipo' => 'libro',
            'idioma' => 'Español',
            'editorial' => 'Alianza'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'Videoreseñas de booktubers como espacios de mediación literaria',
            'autor' => 'Lenin Paladines-Paredes, Cristina Aliagas',
            'tipo' => 'artículo',
            'idioma' => 'Español',
            'editorial' => 'Revista Ocnos Vol. 20 Núm. 1'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'The way of kings',
            'autor' => 'Brandon Sanderson',
            'tipo' => 'libro',
            'idioma' => 'Inglés',
            'editorial' => 'Tor Books'
        ]);

        DB::table('ejemplares')->insert([
            'titulo' => 'Self-efficacy as a mediator of neuroticism and perceived stress: Neural perspectives on healthy aging',
            'autor' => 'Lulu Liua, Runyu Huanga, Yu-Jung Shanga, et. al',
            'tipo' => 'articulo',
            'idioma' => 'Inglés',
            'editorial' => 'Revista International Journal of Clinical and Health Psychology Vol. 24, Núm.4'
        ]);
    }
}
