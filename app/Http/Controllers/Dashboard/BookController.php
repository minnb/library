<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Roles;
use App\Models\Categories;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function nxb_list()
    {
        $data = DB::table("s_nha_xuat_ban")->get();;
    	return view('dashboard.book.nxb_list', compact('data'));
    }

    public function author_list()
    {
        $data = DB::table("s_tac_gia")->get();;
        return view('dashboard.book.author_list', compact('data'));
    }

    public function make_list()
    {
        $data = DB::table("s_noi_xuat_ban")->get();;
        return view('dashboard.book.make_list', compact('data'));
    }

    public function nxb_create()
    {
        return view('dashboard.cate.create', compact('code'));
    }

    public function author_create()
    {
        return view('dashboard.cate.create', compact('code'));
    }

    public function postCreate(Request $request)
    {
        try{
            DB::beginTransaction();
                $data = new Categories();
                $parent = $request->parent;
                $cate = Categories::find($request->parent > 0 ? $request->parent : (-1)*$request->parent);
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
            return redirect()->route('get.dashboard.cate.list', ['code'=>$code])->with(['flash_message'=>'Tạo mới thành công']);
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
            return view('dashboard.cate.edit', compact('data','code'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
	
    public function postEdit(Request $request,$id)
    {
        try{
            DB::beginTransaction();
                $data = Categories::find($id);

                $data->save();
                
            DB::commit();
            return redirect()->route('get.dashboard.cate.list', ['code'=>$code])->with(['flash_message'=>'Chỉnh sửa dữ liệu thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function delete($code, $id)
    {
        try
        {
            DB::beginTransaction();
                DB::table('m_categories')->where('id', $id)->update(['blocked'=>1]);
            DB::commit();
            return redirect()->route('get.dashboard.cate.list', ['code'=>$code])->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
}
