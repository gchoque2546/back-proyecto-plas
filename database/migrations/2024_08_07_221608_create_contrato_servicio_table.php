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
        Schema::create('contrato_servicio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("contrato_id")->unsigned();
            $table->bigInteger("servicio_id")->unsigned();
            $table->integer("cantidad")->default(1);
            //N:M
            $table->foreign("contrato_id")->references("id")->on("contratos");
            $table->foreign("servicio_id")->references("id")->on("servicios");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_servicio');
    }
};
