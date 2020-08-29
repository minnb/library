<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Log; use DB;
use Auth;use Image;
use App\Models\User;
use App\Models\Roles;
use App\Models\Role_User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = User::orderBy('id', 'DESC')->get();
    	return view('dashboard.user.list', compact('data'));
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function postCreate(Request $request)
    {
        if($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]))
        {
            try{
                DB::beginTransaction();
                $data = new User();
                $data->name = trim($request->name);
                $data->email = trim($request->email);
                $data->password = Hash::make($request->password);
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->save();

                Role_User::create([
                    'user_id' => $data->id,
                    'role_id' => $request->role,
                ]);

                DB::commit();
                return redirect()->route('get.dashboard.user.list')->with(['flash_message'=>'Tạo mới thành công']);
            }
            catch (\Exception $e) 
            {
                DB::rollBack();
                return back()->withErrors($e->getMessage())->withInput($request->input());
            }
        }
        
    }

    public function edit($id)
    {
        try
        {
            $data = User::find($id);
            return view('dashboard.user.edit', compact('data', 'id'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage());
        }
    }
	
    public function postEdit(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $data = User::find($id);

            $data->blocked = $request->status == 'on' ? 0 : 1;

            if(!empty($request->password) && $request->validate([
                        'password' => ['string', 'min:8', 'confirmed'],
            ]))
            {
                $data->password = Hash::make($request->password);
            }
            
            $data->save();

            Role_User::where('user_id', $id)->update([
                'role_id' => $request->role
            ]);

            DB::commit();
            return redirect()->route('get.dashboard.user.list')->with(['flash_message'=>'Cập nhật thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function delete($id)
    {
        try
        {
            DB::beginTransaction();
                DB::table('users')->where('id', $id)->update(['blocked'=> 1]);
            DB::commit();
            return redirect()->route('get.dashboard.user.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function getRoles()
    {
        $data = Roles::orderBy('id', 'DESC')->get();
        return view('dashboard.user.roles', compact('data'));
    }
}
