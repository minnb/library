<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Author extends Model
{
    protected $table ="s_tac_gia";

    public static function getSelectAuthor(){
        $data = DB::table('s_tac_gia')->where([
            ['blocked', 0]
        ])->select('id','ten_tac_gia as name')->orderBy('ten_tac_gia')->get()->toArray();
        return $data;
    }

}