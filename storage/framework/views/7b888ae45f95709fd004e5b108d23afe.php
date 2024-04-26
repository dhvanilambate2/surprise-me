<!-- latest jquery-->
<script src="<?php echo e(route('/')); ?>/assets/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js-->
<script src="<?php echo e(route('/')); ?>/assets/js/bootstrap/bootstrap.js"></script>
<!-- feather icon js-->
<script src="<?php echo e(route('/')); ?>/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="<?php echo e(route('/')); ?>/assets/js/sidebar-menu.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/config.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/chat-menu.js"></script>
<?php echo $__env->yieldContent('script'); ?>	
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="<?php echo e(route('/')); ?>/assets/js/script.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/theme-customizer/customizer.js"></script>
<!-- login js-->
<!-- Sweet alert-->
<script src="<?php echo e(route('/')); ?>/assets/js/sweet-alert/sweetalert.min.js"></script>
<script>
var SweetAlert_custom = {
    init: function() {
        <?php if(session('success')): ?>
            swal("Success", "<?php echo e(session('success')); ?>", "success")
        <?php endif; ?>

        <?php if(session('error')): ?>
            swal("Error", "<?php echo e(session('error')); ?>", "error")
        <?php endif; ?>

    }
};
(function($) {
    SweetAlert_custom.init()
})(jQuery);
</script>
<!-- Sweet alert-->
<?php /**PATH C:\laragon\www\stage\resources\views/layouts/simple/script.blade.php ENDPATH**/ ?>