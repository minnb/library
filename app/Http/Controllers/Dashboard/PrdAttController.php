<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Attributes;
use App\Models\Product_Attributes;
use Log; use DB;
use Auth;

class PrdAttController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = Product_Attributes::get();
    	return view('dashboard.prd-att.list', compact('data'));
    }

    public function create($code)
    {
        $lstAtt = Attributes::getValuesAttributes($code);
        return view('dashboard.prd-att.create', compact('code','lstAtt'));
    }

    public function postCreate(Request $request, $code)
    {
        if($request->validate([
            'uom' => 'required_without_all',
        ]))
        {
            try{
                DB::beginTransaction();
                    $products = $request->product;
                    foreach($products as $product)
                    {
                        $uoms = $request->uom;
                        foreach($uoms as $uom)
                        {
                            $data = new Product_Attributes();
                            $data->product_id = $product;
                            $data->attribute_id = $uom;
                            $data->code = Attributes::find($uom)->values;
                            $data->lable = $code;
                            $data->width = 0;
                            $data->length = 0;
                            $data->height = 0;
                            $data->weight = 0;
                            $data->cubage = 0;
                            $data->blocked = $request->status == 'on' ? 0 : 1;
                            $data->user_id = Auth::user()->id;
                            $data->save();  
                        }
                    }    

                DB::commit();
                return redirect()->route('get.dashboard.product.prdatt.list')->with(['flash_message'=>'Tạo mới thành công']);
            }
            catch (\Exception $e) 
            {
                DB::rollBack();
                return back()->withErrors($e->getMessage())->withInput($request->input());
            }
        }
    }

    public function edit($code, $id)
    {
        try
        {
            $data = Product_Attributes::find($id);
            return view('dashboard.prd-att.edit', compact('data'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
	
    public function postEdit(Request $request, $code, $id)
    {
        try{
            DB::beginTransaction();
              
            DB::commit();
            return redirect()->route('get.dashboard.product.prdatt.list')->with(['flash_message'=>'Tạo mới thành công']);
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
            	$att = Attributes::find($id);
                if(Product_Attributes::where('code', $att->code)->get()->count() > 0)
                {
                    DB::table('m_attributes')->where('id', $id)->update(['blocked' => 1]);
                }else{
                    DB::table('m_attributes')->where('id', $id)->delete();
                }
            DB::commit();
            return redirect()->route('get.dashboard.product.prdatt.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

}