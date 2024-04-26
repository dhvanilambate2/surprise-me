<?php $__env->startSection('content'); ?>

<style>
@keyframes spinner-border {
  to {
    transform: rotate(360deg);
  }
}

.spinner-border.text-theme {
  animation: spinner-border 1s linear infinite; /* Adjust duration as needed */
}
.btn{
    color: #999999 !important;
    letter-spacing: 0 !important;
    text-transform: none !important;
    text-align: start !important;
}
.th-mean-expand{
        position: absolute;
    right: 0;
    top: 50%;
    font-weight: 400;
    font-size: 12px;
    width: 25px;
    height: 25px;
    line-height: 24px;
    margin-top: -12.5px;
    display: inline-block;
    text-align: center;
    background-color: #ffffff;
    color: var(--title-color);
    box-shadow: 0 0 20px -8px rgba(173, 136, 88, 0.5);
    border-radius: 50%;
}
</style>
<!--==============================
    Breadcumb
============================== -->
<div class="">
    <div class="breadcumb-wrapper  mt-4 d-flex align-items-center flex-column " data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
        <h1 class="breadcumb-title">Projects</h1>
    </div>
</div>
<!--==============================
Gallery Area  
==============================-->
<div class="container pt-4">
    	<form id="filter-form" action="<?php echo e(route('home.search')); ?>" method="POST" enctype="multipart/form-data">
    	     <?php echo csrf_field(); ?>
    	<div class="row" id="filter">
			<div class="form-group col-lg-3 col-sm-12">
			       <input type="text" placeholder="Enter an Address" id="search" class="form-control px-2 px-sm-4" name="search" value="<?php echo e((isset($_GET['search']))? $_GET['search'] : ''); ?>">
			</div>
			<div class="form-group col-lg-9 col-sm-12">
			    <div class="row">
        			<div class="form-group col-md-2 col-sm-6">
        				<select class="filter-type filter form-control" id="homeFor" name="home_for">
        					<option value="" >Select Home For</option>
        					<option value="sale" >Home For Sale</option>
        					<option value="rent" >Home For Rent</option>
        				</select>
        			</div>
        			<div class="form-group col-md-2 col-sm-6">
        				<div class="main-menu form-control p-0">
        				    <ul>
        				        <li class="menu-item-has-children w-100 background">
                                    <a class="btn w-100 p-3">Price</a>
                                    <ul class="sub-menu w-100">
                                        <li>
                                            <form>
                                                <input type="number" id="min_price" name="min_price" placeholder="Min Price">
                                                <label class="mt-1 text-center">To</label>
                                                <input type="number" id="max_price" name="max_price" placeholder="Max Price">
                                            </form>
                                        </li>
                                    </ul>
                                </li>
        				    </ul>
        				</div>
        			</div>
        			<div class="form-group col-md-2 col-sm-6">
        				<div class="main-menu form-control p-0">
        				    <ul>
        				        <li class="menu-item-has-children w-100 background">
                                    <a class="btn w-100 p-3">Total SqFT</a>
                                    <ul class="sub-menu w-100">
                                        <li>
                                            <form>
                                                <input type="number" id="sqft_min" name="sqft_min" placeholder="Min SqFT">
                                                <label class="mt-1 text-center">To</label>
                                                <input type="number" id="sqft_max" name="sqft_max" placeholder="Max SqFT">
                                            </form>
                                        </li>
                                    </ul>
                                </li>
        				    </ul>
        				</div>
        			</div>
        			<div class="form-group col-md-2 col-sm-6">
        				<div class="main-menu form-control p-0">
        				    <ul>
        				        <li class="menu-item-has-children w-100 background">
                                    <a class="btn w-100 py-3 ps-2 pe-0">Bads & Baths </a>
                                    <ul class="sub-menu ">
                                        <li>
                                            <form>
                                                <label class="mt-1">Badrooms</label>
                                                <select class="filter-type filter form-control" id="bads" name="bads">
                                					<option value="">Any</option>
                                					<option value="1">1+</option>
                                					<option value="2">2+</option>
                                					<option value="3">3+</option>
                                					<option value="4">4+</option>
                                					<option value="5">5+</option>
                                				</select>
                                				<label class="mt-1">Bethrooms</label>
                                                <select class="filter-type filter form-control" id="baths" name="baths">
                                					<option value="">Any</option>
                                					<option value="1">1+</option>
                                					<option value="2">2+</option>
                                					<option value="3">3+</option>
                                					<option value="4">4+</option>
                                					<option value="5">5+</option>
                                				</select>
                                                <!--<button type="button" id="bb_btn" class="th-btn mt-3"><span class="line left"></span> Apply <span class="line"></span></button>-->
                                            </form>
                                        </li>
                                    </ul>
                                </li>
        				    </ul>
        				</div>
        			</div>
        			<div class="form-group col-md-2 col-sm-6">
        				<select class="filter-type filter form-control" id="homeType" name="home_type">
        					<option value="">Select Home Type</option>
        					<option value="houses">Houses</option>
        					<option value="apartments">Apartments</option>
        					<option value="townhomes">Townhomes</option>
        				</select>
        			</div>
        			<div class="form-group col-md-2 col-sm-6">
        				<button type="button" id="apply_btn" class="th-btn"> Search</button>
        			</div>
			    </div>
			</div>
    	</div>
	</form>
</div>
	<div class="shape-mockup jump" data-top="500" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

<div class="py-4">
    <div class="container">
        <div class="row gy-30" id="homeData"> <!-- id="homeData" -->
            <?php echo $__env->make('frontend/homeData', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             
        </div>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    </div>

</div>
<!--==============================
Footer Area
==============================-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    var data = <?php echo json_encode($homeDetails); ?>;
    
    function filter() {
        var search = $('#search').val();
        var home_for = $('#homeFor').val();
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var home_type = $('#homeType').val();
        var bads = $('#bads').val();
        var baths = $('#baths').val();
        var sqft_min = $('#sqft_min').val();
        var sqft_max = $('#sqft_max').val();
        var page = $('#hidden_page').val();
       
       $.ajax({ 
            url:"<?php echo e(url('projects')); ?>/?page="+page+"&search="+search+"&home_for="+home_for+"&min_price="+min_price+"&max_price="+max_price+"&home_type="+home_type+"&bads="+bads+"&baths="+baths+"&sqft_min="+sqft_min+"&sqft_max="+sqft_max,
            success:function(data){
                $('#homeData').html('');
                $('#homeData').html(data);
            }
        })
    }
   
   $(document).on('click', '.th-pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        filter();
    }); 
  
    $('#apply_btn').click(function () {
        $('#hidden_page').val(1);
        filter();
    });
        
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/projects.blade.php ENDPATH**/ ?>