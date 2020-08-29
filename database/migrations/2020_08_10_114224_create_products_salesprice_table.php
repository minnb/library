<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSalespriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sales_price', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('store_code',20);
            $table->bigInteger('product_id');
            $table->string('uom',20);
            $table->decimal('unit_price', 8, 3);
            $table->date('from_date');
            $table->date('to_date');
            $table->decimal('min_qtty', 8, 3);
            $table->decimal('max_qtty', 8, 3);
            $table->integer('user_id');
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_salesprice');
    }
}
