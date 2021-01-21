<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissions', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_comission', $precision = 8, $scale = 2);
            $table->date('month_start_date');
            $table->date('month_end_date');
            $table->integer('quantity_orders');
            $table->string('month',45);
            $table->string('year',45);
            $table->unsignedBigInteger('collaborator_id');

            $table->foreign('collaborator_id')
            ->references('id')
            ->on('collaborators');
            
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
        Schema::dropIfExists('comissions');
    }
}
