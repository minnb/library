<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSNoiXuatBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_noi_xuat_ban', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('noi_xuat_ban');
            $table->string('alias')->unique();
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
        Schema::dropIfExists('s_noi_xuat_ban');
    }
}
