<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_categories', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->tinyInteger('type');
            $table->integer('parent');
            $table->string('name');
            $table->string('alias')->unique();
            $table->string('description', 500);
            $table->longText('content');
            $table->string('thumbnail');
            $table->smallInteger('sort');
            $table->string('display', 10);
            $table->boolean('blocked')->default(0);
            $table->json('options');
            $table->smallInteger('user_id');
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
        Schema::dropIfExists('m_categories');
    }
}
