@extends('dashboard.app')
@section('title', 'Product')
@section('page-header', 'Edit')
@section('stylesheet')  
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugin/jquery.filer/css/jquery.filer.css') }}"/>
@endsection
@section('content')
@include('dashboard.layouts.alert')
<form class="form-horizontal" role="form" action="{{ route('post.dashboard.product.edit', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
    @csrf
   <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tên sách </label>
        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Tên sách" name="name" class="col-xs-10 col-sm-5" required="" value="{{ old('name', isset($data) ? $data['ten_sach']: '')}}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Thể loại sách </label>
        <div class="col-xs-4">
            <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Chọn thể loại sách..." name="ma_the_loai[]" required>
                <option value="">  </option>
                {!! getSelectArrayForm(App\Models\Categories::getSelect2Category(1), old('ma_the_loai', isset($data) ? array($data['ma_the_loai']): [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tác giả </label>
        <div class="col-xs-4">
            <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Chọn tác giả..." name="tac_gia[]" required>
                <option value="">  </option>
                {!! getSelectArrayForm(App\Models\Author::getSelectAuthor(), old('tac_gia', isset($data) ? array($data['ma_tac_gia']): [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nhà xuất bản </label>
        <div class="col-xs-4">
            <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Chọn nhà xuất bản..." name="nha_xuat_ban[]" required>
                <option value="">  </option>
                {!! getSelectArrayForm(App\Models\Attributes::getNhaXuatBan(), old('nha_xuat_ban', isset($data) ? array($data['nha_xuat_ban']): [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nơi xuất bản </label>
        <div class="col-xs-4">
            <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Chọn nơi xuất bản..." name="noi_xuat_ban[]" required>
                <option value="">  </option>
                {!! getSelectArrayForm(App\Models\Attributes::getNoiXuatBan(), old('noi_xuat_ban', isset($data) ? array($data['noi_xuat_ban']): [0]) ) !!}
            </select>
        </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Năm xuất bản </label>
       <div class="col-xs-9">
            <div class="col-xs-5 input-group">
                <input class="form-control date-picker" id="id-date-picker-1" type="text" placeholder="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd" name="nam_xuat_ban" required value="{{ old('nam_xuat_ban', isset($data) ? $data['nam_xuat_ban'] : '1990-01-01')}}"/>
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
       </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Đơn giá (<ins>đ</ins>) </label>
       <div class="col-xs-3">
            <input type="number" id="spinner1" name="don_gia" value="{{old('don_gia', isset($data) ? $data['don_gia']:0)}}" placeholder="0" style="text-align: right;" />
            <div class="space-6"></div>
       </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Số trang sách </label>
       <div class="col-xs-3">
            <input type="number" id="spinner1" name="so_trang_sach" value="{{old('so_trang_sach', isset($data) ? $data['so_trang_sach']:0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
       </div>
    </div>
    <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chiều rộng (<ins>cm</ins>)</label>
       <div class="col-xs-3">
            <input type="number" id="spinner1" name="kich_thuoc_rong" value="{{old('kich_thuoc_rong', isset($data) ? $data['kich_thuoc_rong']:0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
       </div>
    </div>
        <div class="form-group ">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chiều cao (<ins>cm</ins>)</label>
       <div class="col-xs-3">
            <input type="number" id="spinner1" name="kich_thuoc_cao" value="{{old('kich_thuoc_cao', isset($data) ? $data['kich_thuoc_cao']:0)}}" placeholder="0" style="text-align: right;"/>
            <div class="space-6"></div>
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
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right">Hình ảnh</label>
        <div class="col-xs-4">
            <label class="ace-file-input">
                <input type="file" id="id-input-file-2" name="fileImage[]">
            </label>
        </div>
    </div>
    @if($data['hinh_anh'] != '')
        <div class="form-group">
            <label class="col-xs-2 control-label no-padding-right" for="form-field-1"></label>
            <div class="col-xs-9">
                <img src="{{asset($data['hinh_anh'])}}" style="max-height: 100px">
            </div>
        </div>
    @endif
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Thông tin xuất bản </label>
        <div class="col-xs-9">
            <textarea name="thong_tin_xuat_ban" rows="3" class="col-xs-9 col-sm-5">{{ old('thong_tin_xuat_ban')}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Giới thiệu sách </label>
        <div class="col-xs-9">
            <textarea name="description" id="description" rows="6" class="col-xs-9 col-sm-5">{{ old('description', isset($data) ? $data['description'] : '')}}</textarea>
        </div>
    </div>
    <div class="form-group hidden">
        <label class="col-xs-2 control-label no-padding-right" for="form-field-1"> Content </label>
        <div class="col-xs-9">
            <textarea name="content" id="content" rows="6" class="col-xs-9 col-sm-5">{{ old('content', isset($data) ? $data['content'] : '')}}</textarea>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-2 col-md-9">
            <button class="btn btn-info" type="Submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Submit
            </button>
            &nbsp; &nbsp; &nbsp;
            <a class="btn" href="#">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Reset
            </a>
            &nbsp; &nbsp; &nbsp;
            <a class="btn btn-success" href="{{ route('get.dashboard.product.list') }}">
                <i class="ace-icon fa fa-list bigger-110"></i>
                Lists
            </a>
        </div>
    </div>
</form>
@endsection
@section("javascript")  
<script src="<?php echo asset('admin/plugin/func_ckfinder.js'); ?>"></script>
<script src="<?php echo asset('admin/plugin/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo asset('admin/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<script src="{{asset('admin/js/select2.min.js') }}"></script>
<script src="{{asset('admin/js/jquery-ui.custom.min.js') }}"></script>
<script src="{{asset('admin/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{asset('admin/js/bootbox.js') }}"></script>
<script src="{{asset('admin/js/bootstrap-multiselect.min.js') }}"></script>
<script src="{{asset('admin/plugin/jquery.filer/js/jquery.filer.min.js') }}"></script>
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

    $('.select2').css('width','500px').select2({allowClear:true})
        $('#select2-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('.select2').addClass('tag-input-style');
             else $('.select2').removeClass('tag-input-style');
    });

    $(document).one('ajaxloadstart.page', function(e) {
        $('[class*=select2]').remove();
        $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox('destroy');
        $('.rating').raty('destroy');
        $('.multiselect').multiselect('destroy');
    });
</script>
@endsection