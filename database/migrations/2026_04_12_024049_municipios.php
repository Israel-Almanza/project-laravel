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
        //
        Schema::create('municipios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('prefijo');
            // Foreign keys
            $table->foreignId('pais_id')->constrained('pais')->cascadeOnDelete();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnDelete();
            $table->foreignId('provincia_id')->constrained('provincias')->cascadeOnDelete();
            
            $table->string('nombre');
            $table->string('coordenadas');
            $table->string('zoom');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
