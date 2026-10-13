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
       Schema::create('simulacions', function(Blueprint $table){

    $table->id();

    $table->string('nombre');
    $table->text('descripcion');

    $table->foreignId('servicio_id')
          ->constrained('servicios');

    $table->foreignId('ambiente_id')
          ->constrained('ambientes');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulacions');
    }
};
