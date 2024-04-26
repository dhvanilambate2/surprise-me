<?php 
$setting = App\Models\SiteSettng::findOrFail('1'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gaia admin">
    <!-- <link rel="icon" href="<?php echo e(route('/')); ?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(route('/')); ?>/assets/images/favicon.png" type="image/x-icon"> -->

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(route('/')); ?>/assets/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(route('/')); ?>/assets/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(route('/')); ?>/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(route('/')); ?>/assets/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(route('/')); ?>/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(route('/')); ?>/assets/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(route('/')); ?>/assets/images/favicon/ms-icon-144x144.png">

    <title>Gaia - <?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('layouts.simple.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>

  </head>
  <body class="">
    <!-- Loader starts-->
    
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <!-- Page Header Start-->
      <?php echo $__env->make('layouts.simple.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php echo $__env->make('layouts.simple.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Page Sidebar Ends-->
        <!-- Right sidebar Start-->
        <?php echo $__env->make('layouts.simple.chat_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Right sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                 <div class="row">
                    <div class="col-lg-6 main-header">
                        <?php echo $__env->yieldContent('breadcrumb-title'); ?>
                        <h6 class="mb-0">admin panel</h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                       <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="<?php echo e(route('/')); ?>"><i class="pe-7s-home"></i></a></li>
                          <?php echo $__env->yieldContent('breadcrumb-items'); ?>
                       </ol>
                    </div>
                 </div>
              </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            
        </div>
        <!-- footer start-->
        <?php echo $__env->make('layouts.simple.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
    <?php echo $__env->make('layouts.simple.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
  </body>
</html>
<?php /**PATH C:\laragon\www\stage\resources\views/layouts/simple/master.blade.php ENDPATH**/ ?>