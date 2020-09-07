<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- page specific plugin styles -->
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('admin/css/fonts.googleapis.com.css') }}" />
    @yield('stylesheet')
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
        <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('admin/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/ace-rtl.min.css') }}" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="{{ asset('admin/js/ace-extra.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript">
        var baseURL = "{!! url('/') !!}";
        window.setTimeout(function() {
            $("#flash-message").fadeTo(800, 0).slideUp(800, function(){
            $(this).remove();
            });
        }, 15000);
    </script>
</head>