<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_identifications', function (Blueprint $table) {
            //$table->id();
            $table->string('codigo',20)->unique();
            $table->string('name',45)->unique();
            $table->char('status',3)->default('A');
            $table->timestamps();

            $table->primary('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_identifications');
    }
}