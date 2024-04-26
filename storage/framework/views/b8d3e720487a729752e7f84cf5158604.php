<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>

  .pointer{
      cursor:pointer;
  }
  .owl-carousel {
    position: relative;
  }

  .owl-carousel .item {
    padding: 1rem;
  }

  .owl-carousel .owl-nav {
    position: absolute;
    top: 35%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center; /* Center vertically */
    transform: translateY(0%);
  }

  .owl-carousel .owl-nav button {
    background: transparent;
    border: none;
    font-size: 16px; /* Adjust the font size for the buttons */
    color: #FFF;
    height: 32px; /* Set the height for rounded appearance */
    width: 32px;  /* Set the width for rounded appearance */
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
  }
  
  .owl-carousel .owl-nav button.owl-next, 
  .owl-carousel .owl-nav button.owl-prev {
    background-color: white !important;
    border-radius: 50%; /* Make it circular */
  }
  
  .owl-carousel .owl-nav button.owl-prev:hover {
     color:#B0B0B0;
  }
  
  .owl-carousel .owl-nav button.owl-next:hover {
     color:#B0B0B0;
  }
  
  .owl-theme .owl-dots, .owl-theme .owl-nav {
    text-align: center;
    -webkit-tap-highlight-color: transparent;
    margin-bottom: -10px; /* Adjust the margin to decrease space */
  }
.icon-text{
    font-size: 0.7rem;
    line-height: 0.7rem;
}
.fa{
    font-weight: 500;
}
.icon-main-div{
    border: 1px solid #999999;
}

</style>

<!--==  
    <!--==============================
    Breadcumb
============================== -->


    <div class="">
        <div class="breadcumb-wrapper  mt-4" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
            <h1 class="breadcumb-title">Home Details</h1>
            <ul class="breadcumb-menu ">
                <li><a href="<?php echo e(url('projects')); ?>">Projects</a></li>
                <li>
                    <?php if($homeDetails->home_for == 'rent'): ?>
                        <a href="<?php echo e(url('home_for_rent')); ?>">Home For Rent</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('home_for_sale')); ?>">Home For Sale</a>
                    <?php endif; ?>
                </li>
                <li><?php echo e($homeDetails->property_name); ?></li>
            </ul>
        </div>
    </div>
    <!--==============================
Service Area
==============================-->
    <section class="space-top space-extra-bottom">
<div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="page-single">
                        <div class="page-img">
                            <?php if($homeDetails->main_image): ?>
                                <a href="<?php echo e(asset('public/images/' . $homeDetails->main_image)); ?>" data-fancybox="gallery">
                                    <img alt="Main Image Preview" width="810px" height="400px" src="<?php echo e(asset('public/images/' . $homeDetails->main_image)); ?>" />
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="sec-btn">
                             <!--  -->
                                <div id="removeToWishlist" class="link-btn pointer" >Remove Form Wishlist</div>
                                <div id="addToWishlist" class="link-btn pointer">Add To Wishlist</div>
                        </div>
                        <h3 class="single-title"><?php echo e($homeDetails->property_name); ?></h3>
                        <div class="service-content">
                            <p class="fs-5"><?php echo e($homeDetails->sub_description); ?></p>
                            <hr>
                            <?php echo $homeDetails->description; ?>

                            <div class="row  mb-40">
                                <h4 class="mb-20">Address</h4>
                                <p class="fw-bold"><?php echo e($homeDetails->address); ?></p>
                                <h4 class="mb-20">Specification & Pricing</h4>
                                <div class="d-flex w-50 justify-content-between">
                                    <div class="">
                                        <h5 class="">Specification </h4>
                                        <p class="fw-bold mb-1">Home Type: <?php echo e($homeDetails->home_type); ?></p>
                                        <p class="fw-bold mb-1">Total Area: <?php echo e(number_format($homeDetails->sqft_width, 2, '.', ',')); ?> sqft</p>
                                        <p class="fw-bold mb-1">Bedrooms: <?php echo e($homeDetails->bedrooms); ?></p>
                                        <p class="fw-bold mb-1">Bathrooms: <?php echo e($homeDetails->bathrooms); ?></p>
                                    </div>
                                    <div class="">
                                        <h5 class="">Pricing </h4>
                                        <p class="fw-bold mb-1">$<?php echo e(number_format($homeDetails->price, 2, '.', ',')); ?></p>
                                    </div>
                                </div>
                            </div>
                        
                            <?php if($homeDetails->getMedia('images')->count() > 0): ?>
                                <h4 class="text-uppercase mb-20">Other Images</h4>
                                 
                                <div class="ctm-carousel-img owl-carousel owl-theme">
                                   
                                    <?php $__currentLoopData = $homeDetails->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <a href="<?php echo e($image->getUrl()); ?>" data-fancybox="gallery">
                                                <img src="<?php echo e($image->getUrl()); ?>" alt="Slide <?php echo e($index); ?>" style="width: 375px; height: 300px; object-fit: cover;">
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                                


                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        
                        <div class="widget  ">
                            <div class="widget-banner">
                                <h4 class="title" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/widget_banner.jpg">Resources</h4>
                                <div class="py-5">
                                    <button type="button" class="th-btn" data-bs-toggle="modal" data-bs-target="#inquireModal"><span class="line left"></span> INQUIRE NOW <span class="line"></span></button>
                                </div>
                                    <hr class="mt-0">
                                    <div class="px-2 pb-3" style="text-align: left;" >
                                        <?php 
                                            $titlesJson = $homeDetails->titles;
                                            $titlesArray = json_decode($titlesJson, true);
                                        ?>
                                         <?php if($homeDetails->getMedia('resources_images')->count() > 0): ?>
                                            <div class="widget widget_download mb-3">
                                                <div class="donwload-media-wrap">
                                                    <?php $__currentLoopData = $homeDetails->getMedia('resources_images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $resources_images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="download-media">
                                                            <div class="download-media_icon">
                                                                <i class="fal fa-file-pdf"></i>
                                                            </div>
                                                            <div class="download-media_info">
                                                                <h5 class="download-media_title"><?php echo e($titlesArray[$index]); ?></h5>
                                                                <span class="download-media_text"><a href="<?php echo e($resources_images->getUrl()); ?>" download> Download </a></span>
                                                            </div>
                                                            <a href="<?php echo e($resources_images->getUrl()); ?>" class="download-media_btn" target="_blank"><i class="far fa-eye"></i></a>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="d-none justify-content-around p-2 m-1 icon-main-div ">
                                        <div>
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <div class="icon-text">Overview</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <div class="icon-text">Key Areas</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-map" aria-hidden="true"></i>
                                            <div class="icon-text">Masterplan</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-object-group" aria-hidden="true"></i>
                                            <div class="icon-text">Units</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-columns" aria-hidden="true"></i>
                                            <div class="icon-text">Floor Plan</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                            <div class="icon-text test-wrap">Amenities <br>and Facilities</div>
                                        </div>
                                        <div>
                                            <i class="fa fa-flag" aria-hidden="true"></i>
                                            <div class="icon-text">Milestone</div>
                                        </div>
                                    </div>
                                    <?php if($homeDetails->instagram || $homeDetails->facebook || $homeDetails->skype || $homeDetails->twitter): ?>
                                    <div class="px-3" style="text-align: left;" >
                                        <div class="py-1" >
                                            <a href="#" class="fs-5 text-light">Link Listing : </a>
                                            <div class="th-social my-3">
                                                <?php if($homeDetails->instagram): ?>
                                                    <a target="_blank" href="<?php echo e($homeDetails->instagram); ?>"><i class="fab fa-instagram"></i></a>
                                                <?php endif; ?>
                                                <?php if($homeDetails->facebook): ?>
                                                    <a target="_blank" href="<?php echo e($homeDetails->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
                                                <?php endif; ?>
                                                <?php if($homeDetails->skype): ?>
                                                    <a target="_blank" href="<?php echo e($homeDetails->skype); ?>"><i class="fab fa-skype"></i></a>
                                                <?php endif; ?>
                                                <?php if($homeDetails->twitter): ?>
                                                    <a target="_blank" href="<?php echo e($homeDetails->twitter); ?>"><i class="fab fa-twitter"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="property_location">
                             <?php echo $homeDetails->property_location; ?>

                        </div>
                    </aside>
                </div>
            </div>
    

        </div>
    </section>
    
<!-- model for INQUIRE NOW -->
<div class="modal fade" id="inquireModal" tabindex="-1" role="dialog" aria-labelledby="inquireModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="inquireModalLabel">Inquire Now</h5>
                <button type="button" class="btn-close text-light fs-1" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Add your contact form here -->
                <form action="<?php echo e(route('contact.store')); ?>" method="POST" class=" needs-validation" novalidate>
                <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Your Name" value="<?php echo e(old('name')); ?>" required>
                            <input type="hidden" class="form-control" name="hid" id="hid" value="<?php echo e($homeDetails->id); ?>" required>
                            <input type="hidden" class="form-control" name="home_mode" id="home_mode" value="<?php echo e($homeDetails->home_for); ?>" required>
                              <div class="invalid-feedback">
                                Please Enter your Name.
                              </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="number" id="number" placeholder="Your Number" value="<?php echo e(old('number')); ?>" required>
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
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Message" required><?php echo e(old('message')); ?></textarea>
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
        </div>
    </div>
</div>
<!-- model for INQUIRE NOW -->



<!-- model for Remove Wishlist -->
<div class="modal fade" id="removeModel" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="inquireModalLabel">Remove Form Wishlist</h5>
                <button type="button" class="btn-close text-light fs-1" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove Item form Wishlist</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="th-btn" id="removeWishlist"><span class="line left"></span> Remove <span class="line"></span></button>
             </div>
        </div>
    </div>
</div>
<!-- model for Remove Wishlist -->
<!--==============================
Footer Area
==============================-->
<!--owl carousel script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script>
    function openRemoveModal() {
        $('#removeModel').modal('show');
    }

    $('#removeToWishlist').click(function() {
        openRemoveModal();
    });
    
    $(document).ready(function() {
        <?php if($wishlist_count == 1): ?>
            $('#removeToWishlist').show();
            $('#addToWishlist').hide();
        <?php else: ?>
            $('#removeToWishlist').hide();
            $('#addToWishlist').show();
        <?php endif; ?>
        
        
        $('#addToWishlist').click(function(e) {
            e.preventDefault(); // Prevent the default action of the link
            
            // Send a POST request using Ajax
            $.ajax({
                url: "<?php echo e(route('wishlist.store')); ?>", // Get the URL from the href attribute
                method: 'POST', // Use the POST method
                data: {
                    "property_id": <?php echo e($homeDetails->id); ?>,
                },
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>" // Include CSRF token
                },
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        if (response.success) {
                            $('#removeToWishlist').show();
                            $('#addToWishlist').hide();
                            swal("Success", response.message, "success");
                        } else if (response.error) {
                            swal("Error", response.message, "error");
                        }
                    }
                            
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        });
        
        $('#removeWishlist').click(function(e) {
            e.preventDefault(); 
            var propertyId = <?php echo e($homeDetails->id); ?>;
            
            $.ajax({
                url: "<?php echo e(route('wishlist.destroy', ':id')); ?>".replace(':id', propertyId),
                method: 'DELETE', 
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>" 
                },
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        if (response.success) {
                            $('#removeToWishlist').hide();
                            $('#addToWishlist').show();
                             $('#removeModel').modal('hide');
                            swal("Success", response.message, "success");
                        } else if (response.error) {
                            swal("Error", response.message, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


    <script>
      Fancybox.bind('[data-fancybox="gallery"]', {
        Thumbs : {
          type: "modern"
        }
      });    
    </script>

<script>
  $('.owl-carousel').owlCarousel({
    loop: false,
    autoplay: false,
    margin: 10,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 2
      }
    }
  });
</script>
<script>
    $("#test").on('click', function() {

  $.fancybox.open([
    {
      src  : 'https://source.unsplash.com/IvfoDk30JnI/1500x1000',
      opts : {
        caption : 'First caption',
        thumb   : 'https://source.unsplash.com/IvfoDk30JnI/240x160'
      }
    },
    {
      src  : 'https://source.unsplash.com/0JYgd2QuMfw/1500x1000',
      opts : {
        caption : 'Second caption',
        thumb   : 'https://source.unsplash.com/0JYgd2QuMfw/240x160'
      }
    }
  ], {
    loop : true,
    thumbs : {
      autoStart : true
    }
  });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/details.blade.php ENDPATH**/ ?>