@extends('dashboard.app')
@section('title', 'Tác giả')
@section('page-header', "Tạo mới")
@section('stylesheet')     
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/chosen.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugin/jquery.filer/css/jquery.filer.css') }}"/>
@endsection
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.cate.book.author.create')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bút danh </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="name" class="col-xs-10 col-sm-5" required="" value="{{ old('name')}}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên tác giả </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="name2" class="col-xs-10 col-sm-5" required="" value="{{ old('name2')}}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Giới tính (Nam/Nữ)</label>
        <div class="col-xs-9">
            <input name="gioi_tinh" class="ace ace-switch ace-switch-7 btn-rotate" type="checkbox" checked="true" />
            <span class="lbl"></span>
        </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Năm sinh </label>
       <div class="col-xs-9">
            <div class="col-xs-5 input-group">
                <input class="form-control date-picker" id="id-date-picker-1" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" name="nam_sinh" required value="{{ old('nam_sinh')}}"/>
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
       </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Quê quán</label>
        <div class="col-xs-4">
            <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Chọn quê quán..." name="que_quan[]" required>
                <option value="">  </option>
                {!! getSelectArrayForm(App\Models\Province::getSelectProvince(), old('que_quan', isset($data) ? $data['que_quan']: [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Trạng thái</label>
        <div class="col-xs-9">
            <input name="status" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" checked="true" />
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
                Tạo mới
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
<script src="{{asset('admin/js/chosen.jquery.min.js') }}"></script>
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

    if(!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect:true}); 
        //resize the chosen on window resize
        $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
                 var $this = $(this);
                 $this.next().css({'width': $this.parent().width()});
            })
        }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
                 var $this = $(this);
                 $this.next().css({'width': $this.parent().width()});
            })
        });
        $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
        });
    }
</script>
@endsection