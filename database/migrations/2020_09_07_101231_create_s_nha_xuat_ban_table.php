<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSNhaXuatBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_nha_xuat_ban', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ten_nxb');
            $table->string('alias')->unique();
            $table->string('ten_nxb_2');
            $table->string('dia_chi');
            $table->string('dien_thoai', 50);
            $table->string('thong_tin_khac');
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
        Schema::dropIfExists('s_nha_xuat_ban');
    }
}
