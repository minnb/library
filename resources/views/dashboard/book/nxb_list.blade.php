@extends('dashboard.app')
@section('title', 'Nhà xuất bản')
@section('page-header', "Danh sách")
@section('content')
@include('dashboard.layouts.alert')
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="tabbable">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#home">
                <i class="green ace-icon fa fa-home bigger-120"></i>
                Danh sách
            </a>
        </li>
        <li>
            <a href="{{ route('get.dashboard.cate.book.nxb.create') }}">
                <i class="red ace-icon fa fa-pencil  bigger-120"></i>
                Tạo mới 
            </a>
        </li>
    </ul>
    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Id</th>
                    <th>Tên nhà xuất bản</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <a href="{{ route('get.dashboard.cate.book.nxb.edit', ['id'=>$item->id]) }}">{{ $item->id }}</a>
                        </td>
                        <td><a href="{{ route('get.dashboard.cate.book.nxb.edit', ['id'=>$item->id]) }}">{{ $item->ten_nxb }}</a></td>
                        <td>{{ $item->updated_at }}</td>
                        <td>{{ $item->blocked }}</td>

                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green" href="{{ route('get.dashboard.cate.book.nxb.edit', ['id'=>$item->id]) }}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="{{ route('get.dashboard.cate.book.nxb.delete', ['id'=>$item->id]) }}" onclick="return alertDelete();">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('get.dashboard.cate.book.nxb.edit', ['id'=>$item->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('get.dashboard.cate.book.nxb.delete', ['id'=>$item->id]) }}" class="tooltip-error" data-rel="tooltip" title="Delete" onclick="return alertDelete();">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable = 
            $('#dynamic-table')
            //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
            .DataTable( {
                bAutoWidth: false,
                "aoColumns": [
                  { "bSortable": false },
                  null, null,null, null, 
                  { "bSortable": false }
                ],
                "aaSorting": [],
                //"bProcessing": true,
                //"bServerSide": true,
                //"sAjaxSource": "http://127.0.0.1/table.php"   ,
                //,
                //"sScrollY": "200px",
                //"bPaginate": false,
                //"sScrollX": "100%",
                //"sScrollXInner": "120%",
                //"bScrollCollapse": true,
                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                //you may want to wrap the table inside a "div.dataTables_borderWrap" element
                //"iDisplayLength": 50
                select: {
                    style: 'multi'
                }
            } );

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
                
            new $.fn.dataTable.Buttons( myTable, {
                buttons: [
                  {
                    "extend": "colvis",
                    "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    columns: ':not(:first):not(:last)'
                  },
                  {
                    "extend": "copy",
                    "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                  },
                  {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                  },
                  {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                  },
                  {
                    "extend": "pdf",
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                  },
                  {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    message: 'This print was produced using the Print button for DataTables'
                  }       
                ]
            } );
            myTable.buttons().container().appendTo( $('.tableTools-container') );
            //style the message box
                var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });
            
            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {
                defaultColvisAction(e, dt, button, config);
                if($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                    .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                    .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });
        
            setTimeout(function() {
                $($('.tableTools-container')).find('a.dt-button').each(function() {
                    var div = $(this).find(' > div').first();
                    if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);

            $('.show-details-btn').on('click', function(e) {
                e.preventDefault();
                $(this).closest('tr').next().toggleClass('open');
                $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
            });
        })
    </script>
@endsection

