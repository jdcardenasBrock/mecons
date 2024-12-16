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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('taskName')->nullable();

            $table->dateTime('startDate')->nullable();
            $table->dateTime('expyreDate')->nullable();
            $table->integer('durationDays')->nullable();
            $table->string('current_status')->nullable();
            $table->dateTime('extendedDate')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true)->nullable();


            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('id_contact')->nullable();
            $table->foreign('id_contact')->references('id')->on('contacto_clientes');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->timestamps();
            $table->unsignedBigInteger('id_qoute')->nullable();
            $table->foreign('id_qoute')->references('id')->on('cotizacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
