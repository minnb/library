<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSTacGiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_tac_gia', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ten_tac_gia', 120);
            $table->string('ten_tac_gia_2');
            $table->string('alias')->unique();
            $table->date('nam_sinh');
            $table->boolean('gioi_tinh');
            $table->string('que_quan');
            $table->string('the_loai');
            $table->text('gioi_thieu');
            $table->longText('noi_dung');
            $table->json('options');          
            $table->boolean('blocked')->default(0);
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
        Schema::dropIfExists('s_tac_gia');
    }
}
