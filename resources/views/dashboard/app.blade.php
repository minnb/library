<!DOCTYPE html>
<html lang="en">
@include('dashboard.layouts.header')
<body class="no-skin">
	@include('dashboard.layouts.nav')
	    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try { ace.settings.loadState('main-container'); } catch (e) { console.log(e); }
        </script>
        @include('dashboard.layouts.sidebar')
        <div class="main-content">
			<div class="main-content-inner">
			    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
			        <ul class="breadcrumb">
			            <li>
			                <i class="ace-icon fa fa-home home-icon"></i>
			                <a href="{{ URL('/dashboard') }}">Dashboard</a>
			            </li>
			            <li class="active">@yield('title')</li>
			        </ul><!-- /.breadcrumb -->

			        <div class="nav-search" id="nav-search">
			            <form class="form-search">
			                <span class="input-icon">
			                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
			                    <i class="ace-icon fa fa-search nav-search-icon"></i>
			                </span>
			            </form>
			        </div><!-- /.nav-search -->
			    </div>
			    <div class="page-content">
			        <div class="page-header">
			            <h1>
			                @yield('title')
			                <small>
			                    <i class="ace-icon fa fa-angle-right"></i>
			                    @yield('page-header')
			                </small>
			            </h1>
			        </div><!-- /.page-header -->

			        <div class="row">
			            <div class="col-xs-12">
			                @yield('content')
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	@include('dashboard.layouts.footer')
</body>
</html>
