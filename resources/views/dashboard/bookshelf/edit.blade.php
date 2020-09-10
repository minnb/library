@extends('dashboard.app')
@section('title', 'Quản lý kệ sách')
@section('page-header', "Chỉnh sửa")
@section('stylesheet')  
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugin/jquery.filer/css/jquery.filer.css') }}"/>
@endsection
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.ks.edit', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Mã kệ sách </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="so_ke" class="col-xs-10 col-sm-5" readonly value="{{ $data['so_ke'] }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên kệ sách </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-2" name="ten_ke_sach" class="col-xs-10 col-sm-5" required value="{{ old('ten_ke_sach', isset($data) ? $data['ten_ke_sach']: '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Thể loại sách</label>
        <div class="col-xs-10">
            <select multiple="" id="category" name="the_loai_sach[]" class="select2" data-placeholder="Chọn thể loại sách...">
                {!! getSelectArrayForm(App\Models\Categories::getSelect2Category(1), old('the_loai_sach', isset($data) ? convertStrToArr("|", $data['the_loai_sach']): [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chiều rộng (<ins>cm</ins>)</label>
        <div class="col-xs-3">
            <input type="number" id="spinner1" name="chieu_rong" value="{{old('chieu_rong', isset($data) ? $data['chieu_rong']: 0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
        </div>
    </div>
        <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chiều cao (<ins>cm</ins>)</label>
       <div class="col-xs-3">
            <input type="number" id="spinner1" name="chieu_cao" value="{{old('chieu_cao', isset($data) ? $data['chieu_cao']: 0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
       </div>
    </div>
    
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chiều dài (<ins>cm</ins>)</label>
        <div class="col-xs-3">
            <input type="number" id="spinner1" name="chieu_dai" value="{{old('chieu_dai', isset($data) ? $data['chieu_dai']: 0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Thông tin khác</label>
        <div class="col-xs-9">
            <textarea name="thong_tin_khac" id="thong_tin_khac" rows="6" class="col-xs-9 col-sm-5">{{ old('thong_tin_khac', isset($data) ? $data['thong_tin_khac']: 0) }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Trạng thái</label>
        <div class="col-xs-9">
            @if($data['blocked'] == 0)
                <input name="status" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" checked="true" />
            @else
                <input name="status" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" />
            @endif
            <span class="lbl"></span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-2 col-md-9">
            <button class="btn btn-info" type="Submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Lưu thay đổi
            </button>
            &nbsp; &nbsp; &nbsp;
            <a class="btn btn-success" href="{{ route('get.dashboard.cate.book.nxb.list') }}">
                <i class="ace-icon fa fa-list bigger-110"></i>
                Danh sách
            </a>
        </div>
    </div>
</form>
@endsection
@section("javascript")  
<script src="{{asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('admin/js/moment.min.js') }}"></script>
<script src="{{asset('admin/js/daterangepicker.min.js') }}"></script>
<script src="{{asset('admin/js/select2.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });
    });
    $('.select2').css('width','500px').select2({allowClear:true})
        $('#select2-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('.select2').addClass('tag-input-style');
             else $('.select2').removeClass('tag-input-style');
    });
    
    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    })
</script>
@endsection