<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('css'); ?>
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/prism.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/date-picker.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
	<h2>Gaia<span>Dashboard </span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
   <li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Container-fluid starts-->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 xl-100">
         <div class="row">
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-primary o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Sale<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-secondary o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-2"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Users<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-warning o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-3"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Blogs<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-info o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-4"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total listing<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(route('/')); ?>/assets/js/typeahead/handlebars.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/typeahead/typeahead.bundle.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/typeahead/typeahead.custom.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/typeahead-search/handlebars.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/chart/chartist/chartist.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/prism/prism.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/clipboard/clipboard.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/counter/jquery.waypoints.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/counter/jquery.counterup.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/counter/counter-custom.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/custom-card/custom-card.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/notify/bootstrap-notify.min.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/dashboard/default.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/notify/index.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/dashboard/index.blade.php ENDPATH**/ ?>