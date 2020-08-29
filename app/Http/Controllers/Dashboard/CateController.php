<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Roles;
use App\Models\Categories;

class CateController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = Categories::where('parent','>',0)->get();
    	return view('dashboard.cate.list', compact('data'));
    }

    public function create()
    {
        return view('dashboard.cate.create');
    }

    public function postCreate(Request $request)
    {
        try{
            DB::beginTransaction();
                $data = new Categories();
                $cate = Categories::find($request->parent);
                
                $data->type = $cate->type;
                $data->parent = $request->parent == 0 ? 0 : $cate->id;
                $data->name = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->description = empty($request->description)?"":$request->description;
                $data->content = empty($request->content)?"":$request->content;;
                $data->sort = $request->sort;
                $data->display = $request->display;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->options = '{}';

                if($request->file('fileImage')){
                    foreach($request->file('fileImage') as $file ){
                        $destinationPath = path_storage('images');
                        if(isset($file)){
                            $file_name = time().randomString().'.'.$file->getClientOriginalExtension();
                            $file->move($destinationPath, $file_name);
                            $data->thumbnail = $destinationPath.'/'.$file_name;
                        }
                    }
                }else
                {
                    $data->thumbnail = "";
                }

                $data->save();
                
            DB::commit();
            return redirect()->route('get.dashboard.cate.list')->with(['flash_message'=>'Tạo mới thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function edit($id)
    {
        try
        {
            $data = Categories::find($id);
            return view('dashboard.cate.edit', compact('data'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
	
    public function postEdit(Request $request, $id)
    {
        try{
            DB::beginTransaction();
                $data = Categories::find($id);
                $old_img = $data->thumbnail;

                $cate = Categories::find($request->parent);
                $data->type = $cate->type;
                $data->parent = $request->parent == 0 ? 0 : $cate->id;
               
                $data->name = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->description = empty($request->description)?"":$request->description;
                $data->content = empty($request->content)?"":$request->content;;
                $data->sort = $request->sort;
                $data->display = $request->display;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->options = '{}';

                if($request->file('fileImage')){
                    foreach($request->file('fileImage') as $file ){
                        $destinationPath = path_storage('images');
                        if(isset($file)){
                            $file_name = time().randomString().'.'.$file->getClientOriginalExtension();
                            $file->move($destinationPath, $file_name);
                            $data->thumbnail = $destinationPath.'/'.$file_name;
                            delete_image_no_path($old_img);
                        }
                    }
                }

                $data->save();
                
            DB::commit();
            return redirect()->route('get.dashboard.cate.list')->with(['flash_message'=>'Chỉnh sửa dữ liệu thành công']);
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
                DB::table('m_categories')->where('id', $id)->update(['blocked'=>1]);
            DB::commit();
            return redirect()->route('get.dashboard.cate.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
}
