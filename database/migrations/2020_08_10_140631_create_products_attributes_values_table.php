<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAttributesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product_attributes', function (Blueprint $table) {
            $table->id()->autoIncrement();;
            $table->bigInteger('product_id');
            $table->integer('attribute_id');
            $table->string('code',20);
            $table->string('lable', 20);
            $table->decimal('width', 8, 2);         
            $table->decimal('length', 8, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->decimal('cubage', 8, 2);
            $table->boolean('blocked')->default(0);
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('m_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_product_attributes');
    }
}
