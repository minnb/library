<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Bookshelf extends Model
{
    protected $table ="s_ke_sach";

    public static function getMaKeSach()
    {
    	$code = "";
    	$data = Bookshelf::orderBy('so_ke', 'DESC')->first();
    	if($data->count() > 0){
    		$max = (int)substr($data->so_ke, 2, 5) + 1;
    		$stt = str_pad(strval($max),3,"0",STR_PAD_LEFT);
    		$code = 'KS'.$stt;
    	}else{
    		$code = 'KS001';
    	}
    	return $code;
    }
}