<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('css'); ?>
<style>
  .register_btn{
    overflow: hidden;
    z-index: 2;
    position: relative;
    height: 40px;
    background: transparent;
    color: #fff;
    text-transform: uppercase;
    font-size: 15px;
    cursor: pointer;
    margin: 0 50px;
  }
 
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
     .eye-icon{
      position: absolute;
    top: 12px;
    right: 20px;
}
.input-group>.form-control:focus{
    z-index: 0 !important;
}
</style>
<!-- login page start-->
<div class="container-fluid p-0">
  <div class="authentication-main">
     <div class="row">
        <div class="col-md-12">
          <div class="auth-innerright">
            <div class="authentication-box">
              <div class="card-body p-0">
                <div class="cont text-center">
                  <div> 
                    <form class="theme-form" action="<?php echo e(route('login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                      <h4>LOGIN</h4>
                      <h6>Enter your Username and Password</h6>
                      <div class="form-group">
                        <label class="col-form-label pt-0">Your Name</label>
                        <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" type="text" required="" autocomplete="email" autofocus>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      </div>
                      <div class="form-group password-group">
                        <label class="col-form-label">Password</label>
                        <div class="input-group position-relative ">
                            <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" type="password" id="password-field">
                            <div class="input-group-append eye-icon">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      </div>
                      
                      <div class="form-group form-row mt-3 mb-0">
                        <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                      </div>
                      
                    </form>
                  </div>
                  <div class="sub-cont">
                    <div class="img">
                      <div class="img__text">
                        <h2>New here?</h2>
                        <p>Sign up and discover great amount of new opportunities!</p>
                      </div>
                      <a href="<?php echo e(route('register')); ?>"><div class="img__btn"><span class="d-flex align-center justify-content-center">Sign UP</span></div></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
  </div>
</div>
<!-- login page end-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/login.js')); ?>"></script>
<script>
    // Show/hide password functionality
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/auth/login.blade.php ENDPATH**/ ?>