<?php $__env->startSection('title', 'Inquiries Details'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
   .truncate-text {
      max-width: 150px;
      /* Adjust the maximum width according to your design */
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
   }
   .nav-item {
        width: 33%;
        text-align: center;
   }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h2>Inquiries<span>Details</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Inquiries</li>
<li class="breadcrumb-item active">Inquiries Details</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header  justify-content-between align-items-center">
               <div>
               <h5>Inquiries Details</h5>
                <ul class="w-100 nav justify-content-between mt-5 nav-pills nav-primary border rounded-pill p-1" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="sale-tab" data-bs-toggle="pill"
                            href="#sale" role="tab" aria-controls="sale"
                            aria-selected="true" onclick="loadData('sale')">Home For Sale</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rent-tab" data-bs-toggle="pill" href="#rent"
                            role="tab" aria-controls="rent" aria-selected="false" onclick="loadData('rent')">Home For Rent </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="pill" href="#contact"
                            role="tab" aria-controls="contact" aria-selected="false" onclick="loadData('contact')">Contact</a>
                    </li>
                </ul>
               </div>
            </div>
            
             <div class="tab-content" id="myTabsContent">
                
                <div class="tab-pane fade show active" id="sale" role="tabpanel"
                    aria-labelledby="sale-tab">
                    <div class="table-responsive">
                        <table class="table" id="sale-table"> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-nowrap">Number</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 
                <div class="tab-pane fade show" id="rent" role="tabpanel"
                    aria-labelledby="rent-tab">
                    <div class="table-responsive">
                        <table class="table" id="rent-table"> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-nowrap">Number</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="tab-pane fade show" id="contact" role="tabpanel"
                    aria-labelledby="contact-tab">
                    <div class="table-responsive">
                        <table class="table" id="contact-table"> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-nowrap">Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            
         </div>
      </div>

   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function loadData(tab) {
        currentTab = tab;
        // Make an Ajax call to fetch data based on the selected tab
        $.ajax({
            url: '<?php echo e(route("get_inquire_details")); ?>',
            method: 'GET',
            data: { tab: tab }, // Pass the selected tab as a parameter
            success: function (response) {
                // Handle the success response and update the corresponding table
                switch (tab) {
                    case 'sale':
                        $('#sale-table').html(response.tableContent);
                        break;
                    case 'rent':
                        $('#rent-table').html(response.tableContent);
                        break;
                    case 'contact':
                        $('#contact-table').html(response.tableContent);
                        break;
                    default:
                        break;
                }
            },
            error: function (error) {
                // Handle the error if needed
                console.error(error);
            }
        });
    }

    // Initial load for the 'Sale' tab
    loadData('sale');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\raj\gaia\resources\views/backend/inquiries/index.blade.php ENDPATH**/ ?>