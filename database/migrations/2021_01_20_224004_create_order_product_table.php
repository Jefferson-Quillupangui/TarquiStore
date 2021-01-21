<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')
                    ->references('id')
                    ->on('orders');

            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')
                    ->references('id')
                    ->on('products');                  

            $table->integer('quantity');
            $table->decimal('price', $precision = 8, $scale = 2);            
            $table->decimal('total_line', $precision = 8, $scale = 2);
            $table->decimal('comission', $precision = 8, $scale = 2);
            $table->decimal('total_comission', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('order_product');
    }
}
