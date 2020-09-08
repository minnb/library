@extends('dashboard.app')
@section('title', 'Tác giả')
@section('page-header', "Chỉnh sửa")
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.cate.book.author.edit', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bút danh </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="name" class="col-xs-10 col-sm-5" required="" value="{{ old('name', isset($data) ? $data['ten_tac_gia'] : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên tác giả </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="name2" class="col-xs-10 col-sm-5" required="" value="{{ old('name2', isset($data) ? $data['ten_tac_gia_2'] : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Giới tính (Nam/Nữ)</label>
        <div class="col-xs-9">
             @if($data['gioi_tinh'] == 0)
                <input name="status" class="ace ace-switch ace-switch-7 btn-rotate" type="checkbox" checked="true" />
            @else
                <input name="status" class="ace ace-switch ace-switch-7 btn-rotate" type="checkbox" />
            @endif
            <span class="lbl"></span>
        </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Năm sinh </label>
       <div class="col-xs-9">
            <div class="col-xs-5 input-group">
                <input class="form-control date-picker" id="id-date-picker-1" type="text" placeholder="dd/mm/yyyy" data-date-format="yyyy-mm-dd" name="nam_sinh" required value="{{ old('nam_sinh', isset($data) ? $data['nam_sinh'] : '') }}"/>
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
       </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Quê quán</label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="que_quan" class="col-xs-10 col-sm-5" required="" value="{{ old('que_quan', isset($data) ? $data['que_quan'] : '') }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Status</label>
        <div class="col-xs-9">
             @if($data['blocked'] == 0)
                <input name="status" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" checked="true" />
            @else
                <input name="status" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" />
            @endif
            <span class="lbl"></span>
        </div>
    </div>
    <div class="form-group hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Giới thiệu tác giả </label>
        <div class="col-xs-9">
            <textarea name="description" id="description" rows="6" class="col-xs-9 col-sm-5">{{ old('description')}}</textarea>
        </div>
    </div>
    <div class="form-group hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Nội dung </label>
        <div class="col-xs-9">
            <textarea name="content" id="content" rows="6" class="col-xs-9 col-sm-5">{{ old('content')}}</textarea>
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
            <a class="btn btn-success" href="{{ route('get.dashboard.cate.book.author.list') }}">
                <i class="ace-icon fa fa-list bigger-110"></i>
                Tác giả
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