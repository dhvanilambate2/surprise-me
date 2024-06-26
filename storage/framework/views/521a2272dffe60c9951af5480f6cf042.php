<?php $__env->startSection('title', 'Edit Role'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/dropzone.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Edit<span>Role</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Blog</li>
    <a href="<?php echo e(route('roles.index')); ?>" class="breadcrumb-item">Role List</a>
    <li class="breadcrumb-item active">Edit</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Role</h5>
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
                        <form class="row needs-validation themeform" method="post" action="<?php echo e(route('roles.update', $role->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="col-sm-12">
                                <!--<input type="hidden" value="blog" name="home_for">-->
                                <div class="form-group">
                                    <label for="name">Enter Role:</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Role" name="name" value="<?php echo e(old('name', $role->name)); ?>">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                
                                <div class="form-group">
                                <label>Permissions</label><br>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="checkbox" name="permission[]" value="<?php echo e($permission->id); ?>" <?php echo e(in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : ''); ?>> <?php echo e($permission->name); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/backend/roles/edit.blade.php ENDPATH**/ ?>