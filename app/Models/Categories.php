<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Categories extends Model
{
    protected $table ="m_categories";

    public static function getMultiCategory($type){
        return DB::table('m_categories')->where([
            ['blocked', '=', 0], 
            ['type', '=', $type]
        ])->select('id','name', 'parent')->orderBy('name')->get();
    }
    
    public static function getParent($type)
    {
    	return Categories::where('type', $type)->first()->id;
    }
    
    public static function getCateByParent($parent){
        $cate = Categories::where('parent', $parent)->first();
        if($cate->parent == 2){
            return '<span style="color:red">Danh mục cha</span>';
        }else{
            return $cate->name;
        }
    }

    public static function getCateByType($type){
        return DB::select('select * from m_categories where parent > 0 and type = '.$type.' order by name');
    }

    public static function getSelect2Category($type =''){
        $data = DB::table('m_categories')->where([
            ['blocked', 0], 
            ['parent', '>', 0], 
            ['type', '=', $type]
        ])->select('id','name')->orderBy('id')->get()->toArray();
        return $data;
    }

    public static function getCateByArr($arr_id)
    {
    	return DB::table('m_categories')->whereIn('id', $arr_id)->get();
    }

}