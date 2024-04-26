<?php $__env->startSection('title', 'Home For Rent'); ?>

<?php $__env->startSection('css'); ?>
<style>
   .truncate-text {
       max-width: 150px; /* Adjust the maximum width according to your design */
       white-space: nowrap;
       overflow: hidden;
       text-overflow: ellipsis;
   }

   .nav-item {
        width: 20%;
        text-align: center;
   }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
	<h2>Data of <span>Home For Rent</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Properties</li>
    <li class="breadcrumb-item active">Home For Rent</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header ">
            <div class="d-flex justify-content-between align-items-center">
               <h5>Home For Rent</h5>
               <a href="<?= route('home_for_rent.create') ?>"><button class="btn btn-primary btn-sm ">Add Home for Rent</button></a>
            </div>
                <ul class="w-100 nav justify-content-between mt-5 nav-pills nav-primary border rounded-pill p-1" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="publish-tab" data-bs-toggle="pill"
                            href="#publish" role="tab" aria-controls="publish"
                            aria-selected="true" onclick="loadData('publish')">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="archive-tab" data-bs-toggle="pill" href="#archive"
                            role="tab" aria-controls="archive" aria-selected="false" onclick="loadData('archive')">Archived</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rent-tab" data-bs-toggle="pill" href="#rent"
                            role="tab" aria-controls="rent" aria-selected="false" onclick="loadData('rent')">Rented</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="draft-tab" data-bs-toggle="pill" href="#draft"
                            role="tab" aria-controls="draft" aria-selected="false" onclick="loadData('draft')">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-bs-toggle="pill" href="#review"
                            role="tab" aria-controls="review" aria-selected="false" onclick="loadData('review')">Ready for
                            Review</a>
                    </li>
                </ul>

            </div>
            <div class="tab-content" id="myTabsContent">


                
                <div class="tab-pane fade show active" id="publish" role="tabpanel"
                    aria-labelledby="publish-tab">
                    <div class="table-responsive">
                        <table class="table" id="publish-table"> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col" class="text-nowrap">Current Project</th>
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




                
                <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                    <div class="table-responsive">
                        <table class="table" id="archive-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
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




                
                <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                    <div class="table-responsive">
                        <table class="table" id="rent-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
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




                
                <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                    <div class="table-responsive">
                        <table class="table" id="draft-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
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




                
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="table-responsive">
                        <table class="table" id="review-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
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
function updateCurrentProject(selectElement, itemId, isChecked)
{
    var csrfToken = '<?php echo e(csrf_token()); ?>';
    // Make an Ajax call
    $.ajax({
        url: '<?php echo e(route("home_for_rent.update_current_project")); ?>',  // Replace with your actual route
        method: 'POST',
        data: {
            _token: csrfToken, 
            id: itemId,
            is_current_project: isChecked
        },
        success: function (response) {
            // Handle success response if needed
            console.log(response.success);
            var SweetAlert_custom = {
                init: function() {
                        if (response.success) {
                        swal("Success", response.massage, "success");
                    }
                }
            };
            (function($) {
                SweetAlert_custom.init()
            })(jQuery);
        },
        error: function (error) {
            // Handle error if needed
            console.error(error);
        }
    });
}
 
</script>
<script>
    function loadData(tab) {
        currentTab = tab;
        // Make an Ajax call to fetch data based on the selected tab
        $.ajax({
            url: '<?php echo e(route("get_home_details")); ?>',
            method: 'GET',
            data: { tab: tab }, // Pass the selected tab as a parameter
            success: function (response) {
                // Handle the success response and update the corresponding table
                switch (tab) {
                    case 'publish':
                        $('#publish-table').html(response.tableContent);
                        break;
                    case 'archive':
                        $('#archive-table').html(response.tableContent);
                        break;
                    case 'rent':
                        $('#rent-table').html(response.tableContent);
                        break;
                    case 'draft':
                        $('#draft-table').html(response.tableContent);
                        break;
                    case 'review':
                        $('#review-table').html(response.tableContent);
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

    // Initial load for the 'Published' tab
    loadData('publish');
</script>


<script>
  function updateStatus(selectElement, itemId) {
    var newStatus = selectElement.value;
    // Log the selected value to the console
    console.log("Selected Status:", newStatus);

    // Make an AJAX request to update the status in the database
    $.ajax({
        url: "<?php echo e(route('admin.home_for_rent.update_status', ['id' => '__itemId__'])); ?>".replace('__itemId__', itemId),
        method: 'POST',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
            status: newStatus
        },
        success: function(response) {

            // Handle success (optional)

            // Update the UI (as in your original code)
                // Use jQuery to remove classes
                $('.badge' + itemId).removeClass('badge-success badge-warning badge-secondary badge-light badge-danger');

               switch (newStatus) {
                    case 'publish':
                        $('.badge' + itemId).addClass('badge-success').text('Published');
                        break;
                    case 'rented':
                        $('.badge' + itemId).addClass('badge-warning').text('Rented');
                        break;
                    case 'archive':
                        $('.badge' + itemId).addClass('badge-secondary').text('Archived');
                        break;
                    case 'review':
                        $('.badge' + itemId).addClass('badge-danger').text('Ready For Review');
                        break;
                    case 'draft':
                        $('.badge' + itemId).addClass('badge-light').text('Draft');
                        break;
                }
                loadData(currentTab);
            // If the selected status is 'sold', dynamically load and display the sold data
        },
        error: function(error) {
            console.error("Error updating status:", error);
            alert('Failed to update status. Please try again.');
            // Handle error (optional)
        }
    });
}


</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\stage\resources\views/backend/rent/index.blade.php ENDPATH**/ ?>