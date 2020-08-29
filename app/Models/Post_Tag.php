<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Post_Tag extends Model
{
    protected $table ="m_post_tag";

    public static function getArrTags($post_id)
    {
    	$arr = [];
    	$tags = DB::table("m_post_tag")->where('post_id', $post_id)->select('tag_id as id')->get();
    	foreach($tags as $item)
    	{
    		array_push($arr, $item->id);
    	}
    	return $arr;
    }
 
}