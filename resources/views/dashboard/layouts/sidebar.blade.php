<?php
    function getRootCSS($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::contains($route_name, \Str::upper($name))){
            echo "active open";
        }
        else
        {
            echo "";
        }
    }

    function getActiveCSS($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::upper($name) == $route_name || \Str::contains($route_name, \Str::upper($name))){
            echo "active";
        }
        else
        {
            echo "";
        }
    }
    function getActiveCSSByCode($code)
    {
        $route_name = url()->current();
        if(Str::contains($route_name, $code)){
            echo "active";
        }
        else
        {
            echo "";
        }
    }
    function getActiveRoot($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::upper($name) == $route_name){
            echo "active";
        }
        else
        {
            echo "";
        }
    }
?>
<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try { ace.settings.loadState('sidebar'); } catch (e) { console.log(e); }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="{{ getActiveRoot('dashboard') }}">
            <a href="{{ url('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="{{ getRootCSS('dashboard.cate') }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Danh mục sách </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ getActiveCSSByCode('danh-muc-sach') }}">
                    <a href="{{ route('get.dashboard.cate.list', ['code'=>'danh-muc-sach']) }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Thể loại sách
                    </a>
                    <b class="arrow"></b>
                </li>               
                <li class="{{ getActiveCSS('get.dashboard.cate.book.nxb') }}">
                    <a href="{{ route('get.dashboard.cate.book.nxb.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Nhà xuất bản
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="{{ getActiveCSS('get.dashboard.cate.book.author') }}">
                    <a href="{{ route('get.dashboard.cate.book.author.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tác giả
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="{{ getActiveCSS('get.dashboard.cate.book.make') }}">
                    <a href="{{ route('get.dashboard.cate.book.make.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Nơi xuất bản
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="{{ getRootCSS('dashboard.product') }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil"></i>
                <span class="menu-text"> Quản lý Sách </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ getActiveCSS('get.dashboard.product.list') }}">
                    <a href="{{ route('get.dashboard.product.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Quản lý Sách
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        <li class="{{ getRootCSS('dashboard.post') }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Bài viết </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ getActiveCSS('get.dashboard.post.list') }}">
                    <a href="{{ route('get.dashboard.post.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Danh sách
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="{{ getActiveCSS('get.dashboard.post.tag') }}">
                    <a href="{{ route('get.dashboard.post.tag') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tags
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="{{ getRootCSS('dashboard.post') }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Báo cáo </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ getActiveCSS('get.dashboard.post.list') }}">
                    <a href="{{ route('get.dashboard.post.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Theo thể loại sách
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        <li class="{{ getRootCSS('dashboard.user') }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> Users </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{{ getActiveCSS('get.dashboard.user.list') }}">
                    <a href="{{ route('get.dashboard.user.list') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Lists
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="{{ getActiveCSS('get.dashboard.user.roles') }}">
                    <a href="{{ route('get.dashboard.user.roles') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Roles
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-cogs"></i>
                <span class="menu-text"> Setting </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Comppany
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="#">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Slide
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="">
            <a href="#">
                <i class="menu-icon fa fa-calendar"></i>

                <span class="menu-text">
                    Calendar

                    <span class="badge badge-transparent tooltip-error" title="2 Important Events">
                        <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                    </span>
                </span>
            </a>

            <b class="arrow"></b>
        </li>

    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>