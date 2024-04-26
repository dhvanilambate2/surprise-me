<?php $__env->startSection('title', 'Inquiries Details'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* Custom styles for the profile details page */
    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    /* Updated styles for the card and form */
    .card {
        margin-top: 20px;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 8px 8px 0 0;
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control-static {
        font-weight: normal;
        color: #333;
    }

    hr {
        border-color: #007bff;
        margin: 20px 0;
    }

    /* Add some padding and background color to the container */
    .container-fluid {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Inquiries<span>Details</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Inquiries</li>
    <a href="<?php echo e(route('inquiries.index')); ?>" class="breadcrumb-item">Inquiries Details</a>
    <li class="breadcrumb-item active">show</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light p-4">
                    <h4 class="mb-0"><?php echo e($inquiries->name); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border-md-right">
                            <div class="form-group">
                                <label for="email"><strong>Email:</strong></label>
                                <p class="form-control-static"><?php echo e($inquiries->email); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 border-md-right">
                            <div class="form-group">
                                <label for="phone"><strong>Phone:</strong></label>
                                <p class="form-control-static"><?php echo e($inquiries->number); ?></p>
                            </div>
                        </div>
                    </div>
                        <div class="form-group ">
                            <label for="type"><strong>Subject:</strong></label>
                            <p class="form-control-static"><?php echo e($inquiries->subject); ?></p>
                        </div>
                        <div class="form-group">
                            <label for="type"><strong>Message:</strong></label>
                            <p class="form-control-static"><?php echo e($inquiries->massage); ?></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/inquiries/show.blade.php ENDPATH**/ ?>