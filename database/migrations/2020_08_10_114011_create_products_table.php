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
        Schema::create('m_products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('ma_the_loai');
            $table->string('ma_sach',20);
            $table->string('ten_sach');
            $table->string('alias');
            $table->string('hinh_anh',150);
            $table->string('mon_loai',30);
            $table->integer('ma_tac_gia');
            $table->integer('nha_xuat_ban');
            $table->integer('noi_xuat_ban');
            $table->date('nam_xuat_ban');
            $table->string('thong_tin_xuat_ban');
            $table->integer('so_trang_sach');
            $table->integer('don_gia');
            $table->integer('kich_thuoc_rong');
            $table->integer('kich_thuoc_cao');
            $table->text('gioi_thieu_sach');
            $table->longText('noi_dung_sach');
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
        Schema::dropIfExists('m_products');
    }
}
