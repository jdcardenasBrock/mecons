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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contract_number');
            $table->string('invoice_number');
            $table->date('start_date');
            $table->date('estimated_end_date');
            $table->string('engineer_in_charge');
            $table->string('architect_in_charge');
            $table->decimal('total_value', 15, 2);
            $table->decimal('total_cost', 15, 2);
            $table->decimal('profit', 15, 2);
            $table->decimal('margin', 5, 2);
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
        Schema::dropIfExists('projects');
    }
};
