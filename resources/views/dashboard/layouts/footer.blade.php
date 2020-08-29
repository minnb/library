    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">{{ config('app.name', 'Laravel') }}</span>
                    Application &copy; 2020
                </span>

                &nbsp; &nbsp;
                <span class="action-buttons">
                    <a href="#">
                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
<!-- basic scripts -->
<!--[if !IE]> -->
<script src="{{ asset('admin/js/jquery-2.1.4.min.js') }}"></script>
<!-- <![endif]-->
<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('admin/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
</script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<!-- page specific plugin scripts -->
<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('admin/js/jquery-ui.custom.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.sparkline.index.min.js') }}"></script>
    @yield('javascript')
<!-- ace scripts -->
<script src="{{ asset('admin/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('admin/js/ace.min.js') }}"></script>
