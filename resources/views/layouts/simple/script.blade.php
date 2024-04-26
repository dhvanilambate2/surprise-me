<!-- latest jquery-->
<script src="{{route('/')}}/assets/js/jquery-3.5.1.min.js"></script>
<script src="{{route('/')}}/assets/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js-->
<script src="{{route('/')}}/assets/js/bootstrap/bootstrap.js"></script>
<!-- feather icon js-->
<script src="{{route('/')}}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{route('/')}}/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="{{route('/')}}/assets/js/sidebar-menu.js"></script>
<script src="{{route('/')}}/assets/js/config.js"></script>
<script src="{{route('/')}}/assets/js/chat-menu.js"></script>
@yield('script')	
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{route('/')}}/assets/js/script.js"></script>
{{-- <script src="{{route('/')}}/assets/js/theme-customizer/customizer.js"></script> --}}
<!-- login js-->
<!-- Sweet alert-->
<script src="{{route('/')}}/assets/js/sweet-alert/sweetalert.min.js"></script>
<script>
var SweetAlert_custom = {
    init: function() {
        @if (session('success'))
            swal("Success", "{{ session('success') }}", "success")
        @endif

        @if (session('error'))
            swal("Error", "{{ session('error') }}", "error")
        @endif

    }
};
(function($) {
    SweetAlert_custom.init()
})(jQuery);
</script>
<!-- Sweet alert-->
