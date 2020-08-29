<?php

use Illuminate\Database\Seeder;

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
    }
}
