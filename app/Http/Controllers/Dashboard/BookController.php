<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Author;
use App\Models\Product;
use App\Models\Province;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //Tac gia
    public function author_list()
    {
        $data = DB::table("s_tac_gia")->get();;
        return view('dashboard.book.author_list', compact('data'));
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
                $data->ten_tac_gia_2 = trim($request->name2);
                $data->alias = Str::slug($request->name);
                $data->gioi_thieu = empty($request->description)?"":$request->description;
                $data->noi_dung = empty($request->content)?"":$request->content;;
                $data->nam_sinh = date($request->nam_sinh);
                $data->the_loai = "";
                $data->que_quan = $request->que_quan[0];
                $data->gioi_tinh = $request->gioi_tinh == 'on' ? 0 : 1;
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
            $data = Author::find($id);
            return view('dashboard.book.author_edit', compact('data', 'id'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage());
        }
    }
	
    public function postEditAuthor(Request $request, $id)
    {
        try{
            DB::beginTransaction();
                $data = Author::find($id);
                $data->ten_tac_gia = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->nam_sinh = date($request->nam_sinh);
                $data->que_quan = $request->que_quan[0];
                $data->ten_tac_gia_2 = trim($request->name2);
                $data->gioi_tinh = $request->gioi_tinh == 'on' ? 0 : 1;
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
                if(Product::where('ma_tac_gia', $id)->first()){
                    DB::table('s_tac_gia')->where('id', $id)->update(['blocked'=>1]);
                }else{
                    DB::table('s_tac_gia')->where('id', $id)->delete();
                }
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.author.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    //Noi xua ban
    public function make_list()
    {
        $data = DB::table("s_noi_xuat_ban")->get();;
        return view('dashboard.book.make_list', compact('data'));
    }

    //Nha xuat ban
    public function nxb_list()
    {
        $data = DB::table("s_nha_xuat_ban")->get();;
        return view('dashboard.book.nxb_list', compact('data'));
    }

    public function nxb_create()
    {
        return view('dashboard.book.nxb_create');
    }

    public function postCreateNXB(Request $request)
    {
        try{
            DB::beginTransaction();
                DB::table('s_nha_xuat_ban')->insert([
                    'ten_nxb' => trim($request->ten_nxb),
                    'ten_nxb_2' =>  empty($request->ten_nxb_2) ? trim($request->ten_nxb) : trim($request->ten_nxb_2),
                    'alias' => Str::slug($request->ten_nxb),
                    'dien_thoai' => empty($request->dien_thoai)?"":$request->dien_thoai,
                    'dia_chi' => empty($request->dia_chi)?"":$request->dia_chi,
                    'thong_tin_khac' => empty($request->thong_tin_khac)?"":$request->thong_tin_khac,
                    'blocked' => $request->status == 'on' ? 0 : 1,
                    'options' => '{}',
                    'user_id' => Auth::user()->id,
                ]);
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.nxb.list')->with(['flash_message'=>'Tạo mới thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function nxb_edit($id)
    {
        try
        {
            $data = DB::table('s_nha_xuat_ban')->where('id', $id)->get()[0];
            return view('dashboard.book.xnb_edit', compact('data', 'id'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage());
        }
    }

    public function postEditNXB(Request $request, $id)
    {
        try{
            DB::beginTransaction();
                DB::table('s_nha_xuat_ban')->where('id', $id)->update([
                    'ten_nxb' => trim($request->ten_nxb),
                    'ten_nxb_2' =>  empty($request->ten_nxb_2) ? trim($request->ten_nxb) : trim($request->ten_nxb_2),
                    'alias' => Str::slug($request->ten_nxb),
                    'dien_thoai' => empty($request->dien_thoai)?"":$request->dien_thoai,
                    'dia_chi' => empty($request->dia_chi)?"":$request->dia_chi,
                    'thong_tin_khac' => empty($request->thong_tin_khac)?"":$request->thong_tin_khac,
                    'blocked' => $request->status == 'on' ? 0 : 1,
                    'user_id' => Auth::user()->id,
                ]);
            DB::commit();
            return redirect()->route('get.dashboard.cate.book.nxb.list')->with(['flash_message'=>'Chỉnh sửa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }
    public function nxb_delete($id)
    {
        try
        {
            $check = Product::where('ma_tac_gia', $id)->get();
            if($check->count() > 0){
                DB::table('s_nha_xuat_ban')->where('id', $id)->update(['blocked'=>1]);
            }else{
                DB::table('s_nha_xuat_ban')->where('id', $id)->delete();
            }
            return redirect()->route('get.dashboard.cate.book.nxb.list')->with(['flash_message'=>'Thao tác thành công']);
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage());
        }
    }
}
