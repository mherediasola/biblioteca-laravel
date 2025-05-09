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
        Schema::table('prestamos', function(Blueprint $table){
            $table->foreign('id_usuario')->references('id')->on('usuarios')->nullOnDelete()->nullOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestamos', function(Blueprint $table){
            $table->dropForeign('prestamos_id_usuarios_foreign');
        });
    }
};
