<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Bookshelf;
use App\Models\Categories;
use App\Models\Product_Attributes;

class BookshelfController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = Bookshelf::orderBy('id', 'DESC')->get();
    	return view('dashboard.bookshelf.list', compact('data'));
    }

    public function create()
    {
        return view('dashboard.bookshelf.create');
    }

    public function postCreate(Request $request)
    {
        try{
            DB::beginTransaction();
                $data = new Bookshelf();
                $data->so_ke = trim($request->so_ke);
                $data->ten_ke_sach = trim($request->ten_ke_sach);
                $data->thong_tin_khac = empty($request->thong_tin_khac)?"":$request->thong_tin_khac;
                $data->the_loai_sach = implode("|", $request->the_loai_sach);
                $data->chieu_rong = empty($request->chieu_rong)?0:$request->chieu_rong;
                $data->chieu_dai = empty($request->chieu_dai)?0:$request->chieu_dai;
                $data->chieu_cao = empty($request->chieu_cao)?0:$request->chieu_cao;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->options = '{}';
                $data->save();              
            DB::commit();
            return redirect()->route('get.dashboard.ks.list')->with(['flash_message'=>'Tạo mới thành công']);
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
            $data = Bookshelf::find($id);
            return view('dashboard.bookshelf.edit', compact('data', 'id'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage());
        }
    }
	
    public function postEdit(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $data = Bookshelf::find($id);
                $data = Bookshelf::find($id);
                $data->ten_ke_sach = trim($request->ten_ke_sach);
                $data->thong_tin_khac = empty($request->thong_tin_khac)?"":$request->thong_tin_khac;
                $data->the_loai_sach = implode("|", $request->the_loai_sach);
                $data->chieu_rong = empty($request->chieu_rong)?0:$request->chieu_rong;
                $data->chieu_dai = empty($request->chieu_dai)?0:$request->chieu_dai;
                $data->chieu_cao = empty($request->chieu_cao)?0:$request->chieu_cao;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
               
            $data->save();
            DB::commit();
            return redirect()->route('get.dashboard.ks.list')->with(['flash_message'=>'Chỉnh sửa dữ liệu thành công']);
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
                //DB::table('s_ke_sach')->where('id', $id)->update(['blocked'=> 1]);
            DB::commit();
            return redirect()->route('get.dashboard.ks.list')->with(['flash_message'=>'Thao tác thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
}
