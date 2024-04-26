<?php $__env->startSection('content'); ?>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">

<style>
@keyframes spinner-border {
  to {
    transform: rotate(360deg);
  }
}

.spinner-border.text-theme {
  animation: spinner-border 1s linear infinite; /* Adjust duration as needed */
}
</style>
<!--==============================
    Breadcumb
============================== -->
<div class="">
        <div class="breadcumb-wrapper  mt-4 d-flex align-items-center flex-column " data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
            <h1 class="breadcumb-title">Our Projects</h1>
            <div class="widget widget-search border-0 w-50 container ">
                <form id="search-form" class="search-form">
                    <input type="text" placeholder="Search Properties" id="search" class="px-2 px-sm-4" name="search">
                    <button type=button id="search_btn"><i class="far fa-search"></i></button>
                </form>
            </div>  
        </div>
    </div>
<!--==============================
Gallery Area  
==============================-->
<div class="container pt-4">
    	<form id="filter-form" action="<?php echo e(route('home.search')); ?>" method="POST" enctype="multipart/form-data">
    	     <?php echo csrf_field(); ?>
    	<div class="row" id="filter">
			<div class="form-group col-md-3 col-sm-6">
				<select class="filter-type filter form-control" id="homeFor" name="home_for">
					<option value="">Select Home For</option>
					<option value="sale">Home For Sale</option>
					<option value="rent">Home For Rent</option>
				</select>
			</div>
			
			<div class="form-group col-md-3 col-sm-6">
				<select class="filter-price filter form-control" id="min_price" name="min_price">
					<option value="">Select Min Price</option>
					<option value="0">$0</option>
					<option value="10000">$10000</option>
					<option value="20000">$20000</option>
					<option value="30000">$30000</option>
					<option value="40000">$40000</option>
				</select>
			</div>
			<div class="form-group col-md-3 col-sm-6">
				<select class="filter-price filter form-control" id="max_price" name="max_price">
					<option value="">Select Max Price</option>
					<option value="0">$0</option>
					<option value="10000">$10000</option>
					<option value="20000">$20000</option>
					<option value="30000">$30000</option>
					<option value="40000">$40000</option>
				</select>
			</div>
			
			<div class="form-group col-md-3 col-sm-6">
				<select class="filter-type filter form-control" id="homeType" name="home_type">
					<option value="">Select Home Type</option>
					<option value="houses">Houses</option>
					<option value="apartments">Apartments</option>
					<option value="townhomes">Townhomes</option>
				</select>
			</div>
    	</div>
	</form>
</div>
	<div class="shape-mockup jump" data-top="500" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

<div class="py-4">
    <div class="container">
        <div class="row gy-30" id="homeData">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-theme" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <!--<a href="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png" data-fancybox data-caption="Caption for single image">-->
	       <!-- <img src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png" alt="" />-->
        <!--</a>-->
        <div class="text-center mt-5 pt-4">
            <a href="<?php echo e(url('home_for_rent')); ?>" class="th-btn"><span class="line left"></span> Load More <span class="line"></span></a>
        </div>
    </div>

</div>
<!--==============================
Footer Area
==============================-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function () {
        // Toggle visibility of custom price range based on selection
        $('#price_range').change(function () {
            if ($(this).val() === 'custom') {
                $('#custom_price_range').show();
                $('#custom_price_range').show();
                
            } else {
                $('#custom_price_range').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Intercept the form submission and handle it with AJAX
        $('#filter-form').submit(function (e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            // Get form data
            var formData = $('#filter-form').serialize();
            var search = $('#search').val();
            
            formData += '&search=' + search;
            
            // Send the data using AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                success: function (data) {
                    // Handle the success response from the server
                    console.log('Success:', data);
                    $('#homeData').html(data.view); 

                    // Update the DOM with the received data or perform any other actions
                },
                error: function (error) {
                    // Handle the error response from the server
                    console.log('Error:', error);
                }
            });
        });
    });
   $('#homeFor, #min_price, #max_price, #homeType').change(function () {
        $('#filter-form').submit();
    });
    $('#search_btn').click(function () {
        // Trigger the form submission (this will invoke the AJAX call)
        $('#filter-form').submit();
    });
    $(document).ready(function () {
        $('#filter-form').submit();
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/home_details.blade.php ENDPATH**/ ?>