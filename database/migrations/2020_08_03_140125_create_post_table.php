<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_posts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->smallInteger('type');
            $table->string('cate_id', 50);
            $table->string('title');
            $table->string('alias');
            $table->string('thumbnail');
            $table->text('description');
            $table->longText('content');
            $table->json('options');
            $table->integer('votes');
            $table->integer('viewed');
            $table->integer('user_id');
            $table->boolean('blocked')->default(0);
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
        Schema::dropIfExists('m_posts');
    }
}
