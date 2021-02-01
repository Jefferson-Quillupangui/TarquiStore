<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('identification',45)->unique()->nullable();
            $table->string('name',45);
            $table->string('last_name',45);
            $table->mediumtext('address');
            $table->string('phone1',20);
            $table->string('phone2',20)->nullable();
            $table->string('email',45)->nullable();
            $table->char('status',3)->default('A');  
            $table->string('type_identification_cod');

            $table->foreign('type_identification_cod')
            ->references('codigo')
            ->on('type_identifications');

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
        Schema::dropIfExists('clients');
    }
}
