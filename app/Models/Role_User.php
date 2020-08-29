<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Roles;

class Role_User extends Model
{
    protected $table ="role_user";
    protected $fillable = [
        'role_id', 'user_id'
    ];

	public static function insertRoleUser($user_id, $isAdmin){
		$check = Role_User::where('user_id',$user_id)->get();
		$role =  DB::table('roles')->where('is_default', $isAdmin)->first();

		if($check->count() == 0){
			Role_User::create([
                'user_id' => $user_id,
                'role_id' => $role->id
            ]);
            return true;
		}
		else
		{
			return false;
		}
	}

	public static function getRoleByUser($user_id)
	{
		return DB::table('roles')
	            ->join('role_user', 'roles.id', '=', 'role_user.role_id')
	            ->where('role_user.user_id','=', $user_id)
	            ->select('roles.*')
	            ->get()->toArray();
	}
}
