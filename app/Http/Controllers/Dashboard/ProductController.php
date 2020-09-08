<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log; use DB;
use Auth;use Image;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Post_Tag;
use App\Models\Categories;
use App\Models\Product_Attributes;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = Product::orderBy('id', 'DESC')->get();
    	return view('dashboard.product.list', compact('data'));
    }

    public function create()
    {
        return view('dashboard.product.create');
    }

    public function postCreate(Request $request)
    {
        try{
            DB::beginTransaction();
                $data = new Product();
                $data->ma_sach = '';
                $data->ma_the_loai = $request->ma_the_loai[0];
                $data->ten_sach = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->mon_loai = "";
                $data->ma_tac_gia = $request->tac_gia[0];
                $data->nha_xuat_ban = $request->nha_xuat_ban[0];
                $data->noi_xuat_ban = $request->noi_xuat_ban[0];
                $data->nam_xuat_ban = date($request->nam_xuat_ban);
                $data->thong_tin_xuat_ban = empty($request->thong_tin_xuat_ban)?"":$request->thong_tin_xuat_ban;
                $data->so_trang_sach = empty($request->so_trang_sach)?0:$request->so_trang_sach;
                $data->don_gia = empty($request->don_gia)?0:$request->don_gia;
                $data->kich_thuoc_rong = empty($request->kich_thuoc_rong)?0:$request->kich_thuoc_rong;
                $data->kich_thuoc_cao = empty($request->kich_thuoc_cao)?0:$request->kich_thuoc_cao;
                $data->gioi_thieu_sach = empty($request->description)?"":$request->description;
                $data->noi_dung_sach = empty($request->content)?"":$request->content;;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->options = '{}';

                if($request->file('fileImage')){
                    foreach($request->file('fileImage') as $file ){
                        $destinationPath = path_storage('images');
                        if(isset($file)){
                            $file_name = time().randomString().'.'.$file->getClientOriginalExtension();
                            $file->move($destinationPath, $file_name);
                            $data->hinh_anh = $destinationPath.'/'.$file_name;
                        }
                    }
                }
                else
                {
                    $data->hinh_anh = "";
                }

                $data->save();

                DB::table("m_products")->where('id', $data->id)->update(['ma_sach'=>str_pad(strval($data->id),8,"0",STR_PAD_LEFT)]);
                
            DB::commit();
            return redirect()->route('get.dashboard.product.list')->with(['flash_message'=>'Tạo mới thành công']);
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
            $data = Product::find($id);
            return view('dashboard.product.edit', compact('data', 'id'));
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
            $data = Product::find($id);
            $data->ma_the_loai = $request->ma_the_loai[0];
            $data->ten_sach = trim($request->name);
            $data->alias = Str::slug($request->name);
            $data->mon_loai = "";
            $data->ma_tac_gia = $request->tac_gia[0];
            $data->nha_xuat_ban = $request->nha_xuat_ban[0];
            $data->noi_xuat_ban = $request->noi_xuat_ban[0];
            $data->nam_xuat_ban = date($request->nam_xuat_ban);
            $data->thong_tin_xuat_ban = empty($request->thong_tin_xuat_ban)?"":$request->thong_tin_xuat_ban;
            $data->so_trang_sach = empty($request->so_trang_sach)?0:$request->so_trang_sach;
            $data->don_gia = empty($request->don_gia)?0:$request->don_gia;
            $data->kich_thuoc_rong = empty($request->kich_thuoc_rong)?0:$request->kich_thuoc_rong;
            $data->kich_thuoc_cao = empty($request->kich_thuoc_cao)?0:$request->kich_thuoc_cao;
            $data->gioi_thieu_sach = empty($request->description)?"":$request->description;
            $data->noi_dung_sach = empty($request->content)?"":$request->content;;
            $data->blocked = $request->status == 'on' ? 0 : 1;
            $data->user_id = Auth::user()->id;
            
            if($request->file('fileImage')){
                foreach($request->file('fileImage') as $file ){
                    $destinationPath = path_storage('images');
                    if(isset($file)){
                        $file_name = time().randomString().'.'.$file->getClientOriginalExtension();
                        $file->move($destinationPath, $file_name);
                        $data->hinh_anh = $destinationPath.'/'.$file_name;
                    }
                }
            }

            $data->save();
            DB::commit();
            return redirect()->route('get.dashboard.product.list')->with(['flash_message'=>'Chỉnh sửa dữ liệu thành công']);
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
                DB::table('m_products')->where('id', $id)->update(['blocked'=> 1]);
            DB::commit();
            return redirect()->route('get.dashboard.product.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
}
