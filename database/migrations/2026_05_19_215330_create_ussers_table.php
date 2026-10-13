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
       Schema::create('ussers', function (Blueprint $table) {

    $table->id();

    $table->string('nombre');
    $table->string('apellido');
    $table->string('documento')->unique();
    $table->string('correo')->unique();
    $table->string('telefono');
    $table->string('usuario')->unique();
    $table->string('password');

    $table->enum('estado',['Activo','Inactivo'])
          ->default('Activo');

    $table->foreignId('role_id')
          ->constrained('roles');

    // Instructor
    $table->string('especialidad')->nullable();
    $table->string('profesion')->nullable();
    $table->integer('experiencia')->nullable();

    // Aprendiz
    $table->string('ficha')->nullable();
    $table->string('programa')->nullable();
    $table->integer('trimestre')->nullable();

    $table->rememberToken();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussers');
    }
};
