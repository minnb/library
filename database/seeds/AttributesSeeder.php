<?php

use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('m_attributes')->insert([
            'parent' => 0,
            'code' => "UOM",
            'values' => "",
            'description' => 'Đơn vị tính',
            'user_id' => 0,
        ]);

         DB::table('m_attributes')->insert([
            'parent' => 0,
            'code' => "SIZE",
            'values' => "",
            'description' => 'Kích thước',
            'user_id' => 0,
        ]);

        DB::table('m_attributes')->insert([
            'parent' => 0,
            'code' => "COLOR",
            'values' => "",
            'description' => 'Màu sắc',
            'user_id' => 0,
        ]);
    }
}

