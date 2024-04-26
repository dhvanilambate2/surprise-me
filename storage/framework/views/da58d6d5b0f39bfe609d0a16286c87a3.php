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
                           <h5 class="f-w-700 mb-0">Total Sale<span class="pull-right"> <?php echo e($total_sale_count); ?>  </span></h5>
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
                           <h5 class="f-w-700 mb-0">Total Users<span class="pull-right"> <?php echo e($total_user_count); ?>  </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
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
                           <h5 class="f-w-700 mb-0">Total listing<span class="pull-right"><?php echo e($total_home_count); ?>  </span></h5>
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
<!-- <script src="<?php echo e(route('/')); ?>/assets/js/dashboard/default.js"></script> -->
<script src="<?php echo e(route('/')); ?>/assets/js/notify/index.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?php echo e(route('/')); ?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>

<script>
    var saleMonthlyCounts = <?php echo json_encode($sale_count, 15, 512) ?>; // Assuming $sale_count is an array passed from the controller
    var userMonthlyCounts = <?php echo json_encode($user_count, 15, 512) ?>;
    var homeMonthlyCounts = <?php echo json_encode($home_count, 15, 512) ?>;

    // For chart sale 
    var options = {
        chart: {
            height: 120,
            type: "line",
            stacked: false,
            toolbar: {
                show: false
            },
            dropShadow: {
                enabled: true,
                enabledOnSeries: undefined,
                top: 2,
                left: 10,
                blur: 2,
                color: '#561ba3',
                opacity: 0.5
            }
        },
        dataLabels: {
            enabled: false
        },
        series: [
            {
                name: "Home For Sale",
                data: Object.values(saleMonthlyCounts) // Use Object.values to extract values from the associative array
            }
        ],
        stroke: {
            lineCap: 'butt',
            width: [ 8 ],
            curve: 'smooth'
        },
        colors: ["#ffffff"],
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0
            }
        },
        yaxis: {
            show: false,
        },
        xaxis: {
            categories: Object.keys(saleMonthlyCounts).map(month => {
                // You may format the month here as needed
                return month;
            }),
            low: 0,
            offsetX: 0,
            offsetY: 0,
            show: false,
            labels: {
                low: 0,
                offsetX: 0,
                show: false,
            },
            axisBorder: {
                low: 0,
                offsetX: 0,
                show: false,
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#area-widget-chart"), options);

    chart.render();








    // for chart rent

    var options1 = {
    chart: {
        height: 130,
        type: "line",
        stacked: false,
        toolbar: {
            show: false
        },
        dropShadow: {
            enabled: true,
            enabledOnSeries: undefined,
            top: 2,
            left: 10,
            blur: 2,
            color: '#fd3484',
            opacity: 0.5
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [
        {
            name: "Series 1",
            data: Object.values(userMonthlyCounts)
        }
    ],
    stroke: {
        lineCap: 'butt',
        width: [ 8 ],
        curve: 'smooth'
    },
    colors: ["#ffffff"],
    grid: {
        show: false,
        padding: {
            left: 0,
            right: 0
        }
    },
    yaxis: {
        show: false,
    },
    xaxis: {
        categories: Object.keys(userMonthlyCounts).map(month => {
            // You may format the month here as needed
            return month;
        }),
        low: 0,
        offsetX: 0,
        offsetY: 0,
        show: false,
        labels: {
            low: 0,
            offsetX: 0,
            show: false,
        },
        axisBorder: {
            low: 0,
            offsetX: 0,
            show: false,
        }
    }
};

var chart1 = new ApexCharts(document.querySelector("#area-widget-chart-2"),
    options1
);

chart1.render();



var options3 = {
    chart: {
        height: 130,
        type: "line",
        stacked: false,
        toolbar: {
            show: false
        },
        dropShadow: {
            enabled: true,
            enabledOnSeries: undefined,
            top: 2,
            left: 10,
            blur: 2,
            color: '#06b5ca',
            opacity: 0.5
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [
        {
            name: "Series 1",
            data: Object.values(homeMonthlyCounts)
        }
    ],
    stroke: {
        lineCap: 'butt',
        width: [ 8 ],
        curve: 'smooth'
    },
    colors: ["#ffffff"],
    grid: {
        show: false,
        padding: {
            left: 0,
            right: 0
        }
    },
    yaxis: {
        show: false,
    },
    xaxis: {
        categories: Object.keys(homeMonthlyCounts).map(month => {
            // You may format the month here as needed
            return month;
        }),
        low: 0,
        offsetX: 0,
        offsetY: 0,
        show: false,
        labels: {
            low: 0,
            offsetX: 0,
            show: false,
        },
        axisBorder: {
            low: 0,
            offsetX: 0,
            show: false,
        }
    }
};

var chart3 = new ApexCharts(document.querySelector("#area-widget-chart-4"),
    options3
);

chart3.render();
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/dashboard/index.blade.php ENDPATH**/ ?>