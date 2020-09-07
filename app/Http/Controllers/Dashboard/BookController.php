<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Author;


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
        return view('dashboard.book.author_create');
    }

    public function postCreateAuthor(Request $request)
    {
        try{
            DB::beginTransaction();
                $data = new Author();
                $data->ten_tac_gia = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->gioi_thieu = empty($request->description)?"":$request->description;
                $data->noi_dung = empty($request->content)?"":$request->content;;
                $data->nam_sinh = $request->nam_sinh;
                $data->the_loai = "";
                $data->que_quan = $request->que_quan;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->options = '{}';
                $data->save();
                
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.author.list')->with(['flash_message'=>'Tạo mới thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function author_edit($id)
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
	
    public function postEditAuthor(Request $request,$id)
    {
        try{
            DB::beginTransaction();
                $data = Author::find($id);
                $data->ten_tac_gia = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->nam_sinh = $request->nam_sinh;
                $data->que_quan = $request->que_quan;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->save();  
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.author.list')->with(['flash_message'=>'Chỉnh sửa dữ liệu thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function author_delete($id)
    {
        try
        {
            DB::beginTransaction();
                DB::table('s_tac_gia')->where('id', $id)->update(['blocked'=>1]);
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.author.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
}