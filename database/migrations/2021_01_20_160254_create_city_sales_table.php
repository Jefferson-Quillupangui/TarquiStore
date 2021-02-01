<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_sales', function (Blueprint $table) {
            //$table->id();
            $table->string('codigo',20)->unique();
            $table->string('name',45)->unique();
            $table->char('status',3)->default('A');

            $table->primary('codigo');

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
        Schema::dropIfExists('city_sales');
    }
}
