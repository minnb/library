<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_categories')->insert([
            'type' => 0,
            'parent' => 0,
            'name' => '__POST__',
            'alias' => 'post',
            'description' => 'Root category',
            'content' => 'Root category',
            'thumbnail' => '',
            'sort' => 0,
            'display' => '',
            'blocked' => 0,
            'options' => '{}',
            'user_id' =>0,
        ]);

        DB::table('m_categories')->insert([
            'type' => 1,
            'parent' => 0,
            'name' => '__PRODUCT__',
            'alias' => 'product',
            'description' => 'Root category',
            'content' => 'Root category',
            'thumbnail' => '',
            'sort' => 1,
            'display' => '',
            'blocked' => 0,
            'options' => '{}',
            'user_id' =>0,
        ]);

        DB::table('s_noi_xuat_ban')->insert([
            'noi_xuat_ban' => 'Hà Nội',
            'alias' => 'ha-noi',
            'options' => '{}',
            'blocked' => 0,
            'user_id' =>0,
        ]);
        DB::table('s_noi_xuat_ban')->insert([
            'noi_xuat_ban' => 'Hồ Chí Minh',
            'alias' => 'ho-chi-minh',
            'options' => '{}',
            'blocked' => 0,
            'user_id' =>0,
        ]);

        DB::table('s_nha_xuat_ban')->insert([
            'ten_nxb' => 'NXB Giáo dục Việt Nam',
            'alias' => Str::slug('NXB Giáo dục Việt Nam'),
            'ten_nxb_2' => 'Nhà xuất bản Giáo dục Việt Nam',
            'dia_chi' => 'Số 81 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội',
            'dien_thoai' => '024.38.220.554',
            'thong_tin_khac' => '',
            'options' => '{}',
            'blocked' => 0,
            'user_id' =>0,
        ]);
        DB::table('s_nha_xuat_ban')->insert([
            'ten_nxb' => 'NXB Chính trị quốc gia sự thật',
            'alias' => Str::slug('NXB Chính trị quốc gia sự thật'),
            'ten_nxb_2' => 'Nhà xuất bản Chính trị quốc gia sự thật',
            'dia_chi' => 'Số 24 Quang Trung - Hoàn Kiếm - Hà Nội',
            'dien_thoai' => '024.3822-1633',
            'thong_tin_khac' => '',
            'options' => '{}',
            'blocked' => 0,
            'user_id' =>0,
        ]);

        DB::table('s_tac_gia')->insert([
            'ten_tac_gia' => 'Tố Hữu',
            'alias' => Str::slug('Tố Hữu'),
            'nam_sinh' => '1920-10-04',
            'que_quan' => 'Hội An - Quảng Nam',
            'the_loai' => '',
            'gioi_thieu' => '',
            'noi_dung' => '',
            'options' => '{}',
            'blocked' => 0,
            'user_id' =>0,
        ]);
    }
}
