<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Province extends Model
{
    protected $table ="m_province";

    public static function getSelectProvince(){
        $data = DB::table('m_province')->select('id','name')->orderBy('name')->get()->toArray();
        return $data;
    }

}