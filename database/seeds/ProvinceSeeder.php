<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    

    public function run()
    {
    	try{
            DB::beginTransaction();
                DB::statement(str_province());
        		DB::statement(str_distict());
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();           
        }

    }
}
