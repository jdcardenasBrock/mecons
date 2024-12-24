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

            $table->unsignedBigInteger('marca')->nullable();
            $table->foreign('marca')->references('id')->on('marcas');
            $table->unsignedBigInteger('nombre_modelo')->nullable();
            $table->foreign('nombre_modelo')->references('id')->on('nombre_modelos');
            $table->unsignedBigInteger('modelo')->nullable();
            $table->foreign('modelo')->references('id')->on('modelos');
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
