@extends('dashboard.app')
@section('title', 'Nhà xuất bản')
@section('page-header', "Chỉnh sửa")
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.cate.book.nxb.edit', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên nhà xuất bản </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="ten_nxb" class="col-xs-10 col-sm-5" required="" value="{{ old('ten_nxb', isset($data) ? $data->ten_nxb : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên đầy đủ </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="ten_nxb_2" class="col-xs-10 col-sm-5"  value="{{ old('ten_nxb_2', isset($data) ? $data->ten_nxb_2 : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Số điện thoại</label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="dien_thoai" class="col-xs-10 col-sm-5"  value="{{ old('dien_thoai', isset($data) ? $data->dien_thoai : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Địa chỉ</label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="dia_chi" class="col-xs-10 col-sm-5"  value="{{ old('dia_chi', isset($data) ? $data->dia_chi : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Thông tin khác</label>
        <div class="col-xs-9">
            <textarea name="thong_tin_khac" id="thong_tin_khac" rows="6" class="col-xs-9 col-sm-5">{{ old('thong_tin_khac', isset($data) ? $data->thong_tin_khac : '') }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Trạng thái</label>
        <div class="col-xs-9">
             @if($data->blocked == 0)
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
<script src="<?php echo asset('admin/plugin/func_ckfinder.js'); ?>"></script>
<script src="<?php echo asset('admin/plugin/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo asset('admin/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
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
    
    $(document).ready(function(){
        ckeditor('description')
        $('.textarea').wysihtml5();
      });
    $(document).ready(function(){
        ckeditor('content')
        $('.textarea').wysihtml5();
      });

    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    })
</script>
@endsection