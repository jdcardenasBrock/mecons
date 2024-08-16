<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_clientes', function (Blueprint $table) {
            $table->id();

            $table->string('marca')->nullable();
            $table->string('nombre_modelo')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial')->nullable();
            $table->string('numero_interno')->nullable();
            $table->string('ubicacion')->nullable();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_clientes');
    }
};
