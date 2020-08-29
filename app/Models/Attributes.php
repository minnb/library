<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Attributes extends Model
{
    protected $table ="m_attributes";

    public static function getOptionAttributes($parent){
        return DB::select('select id, code as name from m_attributes where parent = '.$parent.' order by code');
    }

    public static function getValuesAttributes($code){
        return DB::table('m_attributes')->where([
            ['parent', '>', 0],
            ['code', $code]
            ])->orderBy('values')->get();
    }

    public static function getSelect2Category($type =''){
        $data = DB::table('m_categories')->where([
            ['blocked', 0], 
            ['parent', '>', 0], 
            ['type', '=', $type]
        ])->select('id','name')->orderBy('id')->get()->toArray();
        return $data;
    }

}