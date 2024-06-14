
<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/dropzone.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>

.password-input {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Edit<span>User</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Profile</li>
    <a href="<?php echo e(url('profile')); ?>" class="breadcrumb-item">Profile Details</a>
    <li class="breadcrumb-item active">Edit Profile</li>
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
                        <form class="row themeform" method="post" action="<?php echo e(url('admin/profile/update', $users->id)); ?>" enctype="multipart/form-data" id="myForm">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?> <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <input type="hidden" value="sale" name="home_for">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="<?php echo e(old('name', $users->name)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" type="email" placeholder="Enter Email" name="email" value="<?php echo e(old('email', $users->email)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input class="form-control" id="phone" type="text" placeholder="Enter Number" name="phone" value="<?php echo e(old('phone', $users->phone)); ?>">
                                </div>
                            </div>
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">Submit</button>
                                <button class="btn btn-light btn-pill" type="button" onclick="cancelForm()">Discard</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body add-post">
                       
                        <form class="row themeform" method="post" action="<?php echo e(url('admin/password/update', $users->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="col-sm-12">
                                <div>
                                    <label for="old_password">Old Password</label>
                                    <div class="password-input">
                                        <input id="old_password" type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
                                        <i class="fa fa-eye toggle-password" onclick="togglePasswordVisibility('old_password', this)"></i>
                                    </div>
                                    <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="error_msg"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="my-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <div class="password-input">
                                        <input id="new_password" type="password" name="new_password" class="form-control" placeholder="Enter New Password">
                                        <i class="fa fa-eye toggle-password" onclick="togglePasswordVisibility('new_password', this)"></i>
                                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="error_msg"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">Submit</button>
                                <button class="btn btn-light btn-pill" type="button" onclick="cancelForm()">Discard</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <script>
        function cancelForm() {
            document.getElementById('myForm').reset();
        }
    </script>
    <script>
        function togglePasswordVisibility(inputId, icon) {
            const passwordInput = document.getElementById(inputId);
        
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\raj\surprise_me\resources\views/backend/profile/edit.blade.php ENDPATH**/ ?>