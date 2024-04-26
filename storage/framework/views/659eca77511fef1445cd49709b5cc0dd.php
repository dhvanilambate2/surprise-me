<?php $__env->startSection('content'); ?>
<?php 
$setting = App\Models\SiteSettng::findOrFail('1'); 
?>
 <!--==============================
    Breadcumb
============================== -->




<div class="">
    <div class="breadcumb-wrapper mt-4 " data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/conatct.png">
        <h1 class="breadcumb-title">Contact Us</h1>
        <ul class="breadcumb-menu d-none">
            <li><a href="index.html">Home</a></li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<!--==============================
contact Area  
==============================-->
<section class="space">
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>
    <div class="container">
        <div class="space-bottom">
            <div class="footer-info-box wow fadeInUp" data-wow-delay="0.2s">
                <div class="row gx-0 justify-content-between">
                    <div class="col-lg-4 col-sm-auto">
                        <div class="footer-box d-flex justify-content-center align-items-center">
                            <h6 class="footer-info has-icon">
                                <i class="far fa-envelope"></i>
                                <a class="link" href="mailto:<?php echo e($setting->email); ?>"><?php echo e($setting->email); ?></a>
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md order-3 order-md-0">
                        <div class="footer-box d-flex justify-content-center align-items-center">
                            <h6 class="footer-info has-icon">
                                <i class="far fa-phone"></i>
                                <a class="link" href="tel:+1<?php echo e($setting->phone); ?>">+(1) <?php echo e($setting->phone); ?></a>
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-auto">
                        <div class="footer-box d-flex justify-content-center align-items-center">
                            <h6 class="footer-info has-icon">
                                <i class="far fa-location-dot"></i>
                                <div class="link"><?php echo e($setting->address); ?></div>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-xl-6 mb-5 mb-xl-0 wow fadeInLeft" data-wow-delay="0.2s">
                <span class="h6 mt-n2 mb-3 text-theme">Contact Us</span>
                <h2 class="sec-title mb-45">Do you need any help? <br>Send <span class="text-theme">Message.</span></h2>
                <!--<form action="<?php echo e(route('contact.store')); ?>" method="POST" class="contact-form needs-validation" >-->
                <form class="needs-validation" novalidate action="<?php echo e(route('contact.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Your Name" value="<?php echo e(old('name')); ?>" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please Enter your Name.
                              </div>
                            <input type="hidden" class="form-control" name="hid" id="hid" value="0" required>
                            <input type="hidden" class="form-control" name="home_mode" id="home_mode" value="contact" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="number" id="number"  placeholder="Your Number" value="<?php echo e(old('number')); ?>" required>
                             <div class="invalid-feedback">
                                Please Enter Number.
                             </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" maxlength="50" value="<?php echo e(old('subject')); ?>" required>
                             <div class="invalid-feedback">
                                Please Enter Subject.
                             </div> 
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" maxlength="200" value="<?php echo e(old('email')); ?>" required>
                            <div class="invalid-feedback">
                                Please Enter Email.
                             </div>
                        </div>
                        <div class="form-group col-12">
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Message"  required><?php echo e(old('message')); ?></textarea>
                             <div class="invalid-feedback">
                                Please Enter Message.
                             </div>
                        </div>
                        <div class="form-btn col-12 mt-10">
                            <button type="submit" class="th-btn"><span class="line left"></span> Message Us <span class="line"></span></button>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="contact-map">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3524.505350066064!2d-82.44913972469037!3d27.94780567604553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2c4f6ebf69d51%3A0x6310b79a85368b0f!2s109%20N%2012th%20St%20Suite%201105%2C%20Tampa%2C%20FL%2033602%2C%20USA!5e0!3m2!1sen!2sin!4v1706883468997!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    

    </div>
</section><!--==============================
Footer Area
==============================-->



<?php $__env->stopSection(); ?>





<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/contact.blade.php ENDPATH**/ ?>