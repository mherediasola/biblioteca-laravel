<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->unsignedBigInteger('id_rol')->after('id')->nullable();
            $table->string('nombre')->after('password');
            $table->string('apellidos');
            $table->foreign('id_rol')->references('id')->on('roles')->nullOnDelete()->nullOnUpdate();
        });

        Schema::rename('users', 'usuarios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('id_rol');
            $table->dropColumn('nombre');
            $table->dropColumn('apellidos');
            $table->dropForeign(['id_rol']);
        });
    }
};
