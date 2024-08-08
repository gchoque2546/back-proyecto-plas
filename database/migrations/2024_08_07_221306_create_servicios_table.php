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
        Schema::create('servicios', function (Blueprint $table) {
            //default->valor por defecto
            $table->id();
            $table->string("nombre", 200);
            $table->decimal("precio", 10, 2)->default(0);
            $table->text("descripcion")->nullable();
            $table->boolean("estado")->default(true);
            $table->string("imagen")->nullable();
            // N:1 N Servicios que pertenecen a una Clase
            $table->bigInteger("clase_id")->unsigned();
            $table->foreign("clase_id")->references("id")->on("clases");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
