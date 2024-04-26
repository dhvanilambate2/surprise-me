<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Gaia admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Gaia admin template, dashboard template, flat admin template, responsive admin template, web app (Laravel 8)">
      <meta name="author" content="pixelstrap">
      
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
      <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
      <title>Gaia - <?php echo $__env->yieldContent('title'); ?></title>
      <?php echo $__env->make('layouts.app.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->yieldContent('style'); ?>
   </head>
   <body>
      <!-- Loader starts-->
      
      <!-- Loader ends-->
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
           <?php echo $__env->yieldContent('content'); ?>
      </div>
      <?php echo $__env->make('layouts.app.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </body>
</html>
<?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/layouts/app/master.blade.php ENDPATH**/ ?>