@extends('dashboard.app')
@section('title', 'Thể loại sách')
@section('page-header', "Tạo mới")
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.cate.create',['code'=>$code])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên thể loại sách </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Name" name="name" class="col-xs-10 col-sm-5" required="" value="{{ old('name')}}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Danh mục cha </label>
        <div class="col-xs-4">
            <select class="form-control" id="form-field-select-1" name="parent" required>
                <option value="-2">__{{getDanhMuc($code)}}__</option>
                {!! menuMulti(App\Models\Categories::getMultiCategory(1), 2, "", old('parent', 0)) !!}
            </select>
        </div>
    </div>
    <div class="form-group hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Description </label>
        <div class="col-xs-9">
            <textarea name="description" id="description" rows="6" class="col-xs-9 col-sm-5">{{ old('description')}}</textarea>
        </div>
    </div>
    <div class="form-group  hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Content </label>
        <div class="col-xs-9">
            <textarea name="content" id="content" rows="6" class="col-xs-9 col-sm-5">{{ old('content')}}</textarea>
        </div>
    </div>
    <div class="form-group hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Sort </label>
        <div class="col-xs-9">
            <input type="number" name="sort" placeholder="0" class="col-xs-9 col-sm-5" value="0" style="text-align: center;" value="{{ old('sort')}}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Hiển thị </label>
        <div class="col-xs-4">
            <select class="form-control" id="form-field-select-1" name="display" required="">
                <?php selectedOption(getArrDisplay(), 'Category') ?>
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
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Ảnh sách</label>
        <div class="col-xs-4">
            <label class="ace-file-input">
                <input type="file" id="id-input-file-2" name="fileImage[]">
            </label>
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
            <a class="btn btn-success" href="{{ route('get.dashboard.cate.list', ['code'=>$code]) }}">
                <i class="ace-icon fa fa-list bigger-110"></i>
                {{getDanhMuc($code)}}
            </a>
        </div>
    </div>
</form>
@endsection
@section("javascript")  
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
</script>
@endsection