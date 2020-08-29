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
                $data->sku = '';
                $data->categories = implode("|",$request->category);
                $data->name = trim($request->name);
                $data->alias = Str::slug($request->name);
                $data->description = empty($request->description)?"":$request->description;
                $data->content = empty($request->content)?"":$request->content;;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->tax = '';
                $data->base_unit = '';
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
                }
                else
                {
                    $data->thumbnail = "";
                }

                $data->save();
                DB::table("m_products")->where('id', $data->id)->update(['sku'=>str_pad(strval($data->id),8,"0",STR_PAD_LEFT)]);

                // if(count($request->tags) > 0)
                // {
                //     for ($i = 0; $i < count($request->tags); $i++) {
                //         DB::table('m_post_tag')->insert([
                //             'post_id' => $data->id,
                //             'tag_id' => $request->tags[$i]
                //         ]);
                //     }
                // }
                
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
            $data->categories = implode("|",$request->category);
            $data->name = trim($request->name);
            $data->alias = Str::slug($request->name);
            $data->description = empty($request->description)?"":$request->description;
            $data->content = empty($request->content)?"":$request->content;;
            $data->blocked = $request->status == 'on' ? 0 : 1;
            $data->user_id = Auth::user()->id;
            
            if($request->file('fileImage')){
                foreach($request->file('fileImage') as $file ){
                    $destinationPath = path_storage('images');
                    if(isset($file)){
                        $file_name = time().randomString().'.'.$file->getClientOriginalExtension();
                        $file->move($destinationPath, $file_name);
                        $data->thumbnail = $destinationPath.'/'.$file_name;
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
