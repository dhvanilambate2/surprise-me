<?php $__env->startSection('title', 'Signup'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
   <!-- login page start-->
   <div class="authentication-main">
      <div class="row">
         <div class="col-md-12">
            <div class="auth-innerright">
               <div class="authentication-box">
                  <div class="card-body">
                     <div class="cont text-center">
                        <div>
                           <form class="theme-form" <?php echo e(route('register')); ?> method="post">
                            <?php echo csrf_field(); ?>

                              <h4 class="text-center">NEW USER</h4>
                              <h6 class="text-center">Enter your Username and Password For Signup</h6>
                              <div class="form-row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <input class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" placeholder="First Name" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                                       <?php $__errorArgs = ['name'];
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
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <input class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" placeholder="Phone Number" name="phone" value="<?php echo e(old('phone')); ?>" required autocomplete="phone">
                                       <?php $__errorArgs = ['phone'];
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
                                 </div>
                              </div>
                              <div class="form-group">
                                 <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" placeholder="Enter Email"  name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
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
                              <div class="form-group">
                                 <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" placeholder="Password" name="password" value="<?php echo e(old('password')); ?>" required autocomplete="password">
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
                              <div class="form-row">
                                 <div class="col-sm-4">
                                    <button class="btn btn-primary" type="submit">Sign Up</button>
                                 </div>
                                 <div class="col-sm-8">
                                    <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="<?php echo e(route('login')); ?>">Login</a></div>
                                 </div>
                              </div>
                              <div class="form-divider"></div>
                              <div class="social mt-3">
                                 <div class="form-row btn-showcase">
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-fb">Facebook</button>
                                    </div>
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-twitter">Twitter</button>
                                    </div>
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-google">Google +</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="sub-cont">
                           <div class="img">
                              <div class="img__text">
                                 <h2>New here?</h2>
                                 <p>Sign up and discover great amount of new opportunities!</p>
                              </div>
                              <a href="<?php echo e(route('login')); ?>"><div class="img__btn"><span class="d-flex align-center justify-content-center">Sign IN</span></div></a>

                           </div>
                           <div>
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(route('/')); ?>/assets/js/login.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/auth/register.blade.php ENDPATH**/ ?>