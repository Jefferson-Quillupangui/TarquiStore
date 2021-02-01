<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('delivery_date', $precision = 0);
            $table->mediumtext('delivery_address');
            $table->decimal('total_order', $precision = 8, $scale = 2);
            $table->decimal('total_comission', $precision = 8, $scale = 2);
            $table->mediumtext('observation');

            $table->string('sector_cod');

            $table->foreign('sector_cod')
            ->references('codigo')
            ->on('sectors');

            $table->string('city_sale_cod');

            $table->foreign('city_sale_cod')
            ->references('codigo')
            ->on('city_sales');

            $table->unsignedBigInteger('client_id');

            $table->foreign('client_id')
            ->references('id')
            ->on('clients');

            $table->unsignedBigInteger('collaborator_id');

            $table->foreign('collaborator_id')
            ->references('id')
            ->on('collaborators');


            $table->string('order_status_cod');

            $table->foreign('order_status_cod')
            ->references('codigo')
            ->on('order_statuses');

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
        Schema::dropIfExists('orders');
    }
}
