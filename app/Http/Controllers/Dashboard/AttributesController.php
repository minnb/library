<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Attributes;
use App\Models\Product_Attributes;
use Log; use DB;
use Auth;

class AttributesController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function list()
    {
        $data = Attributes::where('parent','>',0)->get();
    	return view('dashboard.attributes.list', compact('data'));
    }

    public function create($code)
    {
        return view('dashboard.attributes.create', compact('code'));
    }

    public function postCreate(Request $request, $code)
    {
        try{
            DB::beginTransaction();
                $data = new Attributes();
                $att = Attributes::where('code', $code)->first();
                $data->parent = $att->id;
                $data->code = $code;
                $data->values = trim($request->code);
                $data->description = empty($request->description)?"":$request->description;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->save();               
            DB::commit();
            return redirect()->route('get.dashboard.product.att.list')->with(['flash_message'=>'Tạo mới thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

    public function edit($code, $id)
    {
        try
        {
            $data = Attributes::find($id);
            return view('dashboard.attributes.edit', compact('data'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }
	
    public function postEdit(Request $request,$code, $id)
    {
        try{
            DB::beginTransaction();
                $data = Attributes::find($id);
                $data->description = empty($request->description)?"":$request->description;
                $data->blocked = $request->status == 'on' ? 0 : 1;
                $data->user_id = Auth::user()->id;
                $data->save();               
            DB::commit();
            return redirect()->route('get.dashboard.product.att.list')->with(['flash_message'=>'Tạo mới thành công']);
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
            return redirect()->route('get.dashboard.product.att.list')->with(['flash_message'=>'Xóa thành công']);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput($request->input());
        }
    }

}