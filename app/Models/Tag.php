<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Tag extends Model
{
    protected $table ="m_tags";

    public static function getSelect2Tags(){
        $data = DB::table('m_tags')->where([
            ['blocked', 0]
        ])->select('id','name')->orderBy('id')->get()->toArray();
        return $data;
    }
 
}