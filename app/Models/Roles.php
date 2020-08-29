<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;use Log;
use App\Models\Role_User;
class Roles extends Model
{
    protected $table ="roles";
    
    public function users()
	{
	  return $this
	    ->belongsToMany('App\Models\User')
	    ->withTimestamps();
	}

	public static function getRole($id = ""){
		if($id==""){
			return Role::orderBy('id','ASC')->get();
		}else{
			return Role::where('user_id',$id)->get();
		}
	}

	public static function getRoleSelect(){
		$user = DB::table('roles')->select('id','name')->get();
		return $user;
	}

	public static function getSelectMultiRole(){
        $data = DB::table('roles')->select('id','name')->orderBy('id')->get()->toArray();
        return $data;
    }

    public static function isAdmin($user_id)
    {
    	try
    	{
	    	$role = DB::table('roles')
		            ->join('role_user', 'roles.id', '=', 'role_user.role_id')
		            ->select('roles.*')
		            ->where('role_user.user_id', '=', $user_id)
		            ->first();

			if(is_object($role) && !$role->is_admin)
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}
    	}
    	catch (Exception $e) 
    	{
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		    return false;
		}
    }
}
?>