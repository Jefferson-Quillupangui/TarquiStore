<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',75)->unique();
            $table->text('image');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->text('description');
            $table->decimal('comission', $precision = 8, $scale = 2);
            $table->integer('quantity');
            $table->decimal('discount', $precision = 8, $scale = 2)->default(0); 
            $table->decimal('price_discount', $precision = 8, $scale = 2)->default(0);
            $table->char('status',3)->default('A');  
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');

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
        Schema::dropIfExists('products');
    }
}
