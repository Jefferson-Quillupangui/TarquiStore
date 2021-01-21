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

            $table->unsignedBigInteger('sector_id');

            $table->foreign('sector_id')
            ->references('id')
            ->on('sectors');

            $table->unsignedBigInteger('city_sale_id');

            $table->foreign('city_sale_id')
            ->references('id')
            ->on('city_sales');

            $table->unsignedBigInteger('client_id');

            $table->foreign('client_id')
            ->references('id')
            ->on('clients');

            $table->unsignedBigInteger('collaborator_id');

            $table->foreign('collaborator_id')
            ->references('id')
            ->on('collaborators');


            $table->unsignedBigInteger('order_status');

            $table->foreign('order_status')
            ->references('id')
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
