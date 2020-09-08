<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Attributes extends Model
{

    public static function getOptionAttributes($parent){
        return DB::select('select id, code as name from m_attributes where parent = '.$parent.' order by code');
    }

    public static function getSelect2Category($type =''){
        $data = DB::table('m_categories')->where([
            ['blocked', 0], 
            ['parent', '>', 0], 
            ['type', '=', $type]
        ])->select('id','name')->orderBy('id')->get()->toArray();
        return $data;
    }

    public static function getNhaXuatBan(){
        $data = DB::table('s_nha_xuat_ban')->where([
            ['blocked', 0]
        ])->select('id','ten_nxb as name')->orderBy('ten_nxb')->get()->toArray();
        return $data;
    }

    public static function getNoiXuatBan(){
        $data = DB::table('s_noi_xuat_ban')->where([
            ['blocked', 0]
        ])->select('id','noi_xuat_ban as name')->orderBy('noi_xuat_ban')->get()->toArray();
        return $data;
    }

    public static function getObjNXB($id){
        return DB::table('s_nha_xuat_ban')->where('id', $id)->first();
    }
}