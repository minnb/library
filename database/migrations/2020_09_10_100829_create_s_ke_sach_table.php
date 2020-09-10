<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSKeSachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_ke_sach', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('so_ke', 5)->unique();
            $table->string('ten_ke_sach');
            $table->string('thong_tin_khac');
            $table->string('the_loai_sach');
            $table->integer('chieu_rong');
            $table->integer('chieu_cao');
            $table->integer('chieu_dai');
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
        Schema::dropIfExists('s_ke_sach');
    }
}
