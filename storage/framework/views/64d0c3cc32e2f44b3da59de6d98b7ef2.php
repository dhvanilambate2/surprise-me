<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/dropzone.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Edit<span>User</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">User</li>
    <a href="<?php echo e(route('users.index')); ?>" class="breadcrumb-item">User Details</a>
    <li class="breadcrumb-item active">Edit</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit User</h5>
                    </div>
                    <div class="card-body add-post">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form class="row  themeform"  method="post" action="<?php echo e(route('users.update',$users->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?> <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <input type="hidden" value="sale" name="home_for">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="<?php echo e(old('name', $users->name)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="emali">Email</label>
                                    <input class="form-control" id="email" type="email" placeholder="Enter Email" name="email" value="<?php echo e(old('email',$users->email)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input class="form-control" id="phone" type="text" placeholder="Enter Number" name="phone" value="<?php echo e(old('phone',$users->phone)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles:</label>
                                    
                                    <select name="roles[]" class="form-control" >
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleKey => $roleValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($roleKey); ?>" <?php echo e(in_array($roleKey, $userRoles) ? 'selected' : ''); ?>>
                                        <?php echo e($roleValue); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" type="password" placeholder="Enter Password" name="password" >
                                </div>
                            </div>
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">Submit</button>
                                <input class="btn btn-light btn-pill" type="reset" value="Discard">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2-custom.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone-script.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/chat-menu.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/email-app.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/form-validation-custom.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/styles.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Add the following script at the end of your file -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\stage\resources\views/backend/user/edit.blade.php ENDPATH**/ ?>