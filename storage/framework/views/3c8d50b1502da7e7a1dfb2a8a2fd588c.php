<?php $__env->startSection('title', 'Home Page Setting'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .truncate-text {
        max-width: 150px;
        /* Adjust the maximum width according to your design */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
.toggle_input[type=checkbox]{
	height: 0;
	width: 0;
	visibility: hidden;
}

.toggle_label {
	cursor: pointer;
	text-indent: -9999px;
	width: 50px;
	height: 25px;
	background: grey;
	display: block;
	border-radius: 100px;
	position: relative;
}

.toggle_label:after {
	content: '';
	position: absolute;
	top: 5px;
	left: 5px;
	width: 15px;
	height: 15px;
	background: #fff;
	border-radius: 90px;
	transition: 0.3s;
}

.toggle_input:checked + label {
	background: #7e37d8;
}

.toggle_input:checked + label:after {
	left: calc(100% - 5px);
	transform: translateX(-100%);
}

/*.toggle_label:active:after {*/
/*	width: 50px;*/
/*}*/

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h2>Data of <span>Home Page</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Setting</li>
<li class="breadcrumb-item">Home Page</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
     
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    
                    <h5 class="d-flex align-items-center">Our Team Data &nbsp;
                        <input type="checkbox" id="switch" name="team_section" data-section-name="team_section" class="toggle_input" <?php echo e(($team_section->status == 1)? 'checked' : ''); ?>/>
                        <label class="toggle_label mb-0" for="switch">
                            Toggle
                        </label>
                    </h5>
                    <!-- toggle button code  -->
                     
                    
                    <a href="<?= route('setting_home.team_create') ?>"><button class="btn btn-primary btn-sm ">Add Team
                            Data</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-nowrap">Name</th>
                                <th scope="col" class="text-nowrap">Post</th>
                                <th scope="col" class="text-nowrap text-center">Current_Four</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($item->id); ?></th>
                                <td class="truncate-text"><?php echo e($item->name); ?></td>
                                <td class=""><?php echo e($item->post); ?></td>
                                <td class="text-center">
                                    <input class="current-project-checkbox" onchange="updateCurrentProject(this, <?php echo e($item->id); ?>, this.checked)" id="<?php echo e($item->id); ?>"  type="checkbox" <?php echo e(($item->current_four == '1')? "checked" : ''); ?>>
                                </td>
                                <td class="text-nowrap">
                                    
                                    <a href="<?php echo e(route('setting_home.team_edit', $item->id)); ?>"><button
                                            class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                    <!-- Button trigger modal -->

                                    <button class="btn text-danger px-2" type="button" data-toggle="modal"
                                        data-original-title="test" data-target="#exampleModal<?php echo e($item->id); ?>"><i
                                            data-feather="trash-2"></i></button>
                                    <div class="modal fade" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>

                                                    
                                                    <form action="<?php echo e(route('setting_home.team_destroy', $item->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="d-flex align-items-center">Client Review Data &nbsp;
                        <input type="checkbox" id="switchReview" name="review_section" data-section-name="review_section" class="toggle_input" <?php echo e(($review_section->status == 1)? 'checked' : ''); ?>/>
                        <label class="toggle_label mb-0" for="switchReview">
                    </h5>
                    <a href="<?= route('setting_home.review_create') ?>"><button class="btn btn-primary btn-sm ">Add
                            Client Review</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-nowrap">Name</th>
                                <th scope="col" class="text-nowrap">Post</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($item->id); ?></th>
                                <td class="truncate-text"><?php echo e($item->name); ?></td>
                                <td class=""><?php echo e($item->post); ?></td>
                                <td class="text-nowrap">
                                    
                                    <a href="<?php echo e(route('setting_home.review_edit', $item->id)); ?>"><button
                                            class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                    <!-- Button trigger modal -->

                                    <button class="btn text-danger px-2" type="button" data-toggle="modal"
                                        data-original-title="test" data-target="#exampleModalReview<?php echo e($item->id); ?>"><i
                                            data-feather="trash-2"></i></button>
                                    <div class="modal fade" id="exampleModalReview<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>

                                                    
                                                    <form action="<?php echo e(route('setting_home.review_destroy', $item->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<script>
    $(document).ready(function() {
        function changeStatus(status, sectionName)
        {
            var function_status = status; // Assuming 1 represents active and 0 represents inactive
            var function_sectionName = sectionName;
            $.ajax({
                url: '<?php echo e(route("home_section.store")); ?>',
                type: 'POST', // or 'POST' depending on your route definition
                data: {
                     _token: "<?php echo e(csrf_token()); ?>",
                    status: function_status,
                    sectionName: function_sectionName
                },
                success: function(response) {
                    // Handle success response if needed
                    if (response.success) {
                        swal("Success", response.massage, "success");
                    }
                    
                    if (response.error) {
                        swal("Error", response.massage, "error");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                }
            });
        }
     
        
        $('.toggle_input').change(function() {
            var status = $(this).prop('checked') ? 1 : 0; // Assuming 1 represents active and 0 represents inactive
            var sectionName = $(this).data('section-name');
            changeStatus(status, sectionName);
        });
    });
    
    function updateCurrentProject(selectElement, itemId, isChecked)
    {
        var csrfToken = '<?php echo e(csrf_token()); ?>';
        // Make an Ajax call
        $.ajax({
            url: '<?php echo e(route("setting_home.update_current_four")); ?>',  // Replace with your actual route
            method: 'POST',
            data: {
                _token: csrfToken, 
                id: itemId,
                is_current_project: isChecked
            },
            success: function (response) {
                // Handle success response if needed
                var SweetAlert_custom = {
                    init: function() {
                        if (response.success) {
                            swal("Success", response.massage, "success");
                        }
                        
                        if (response.error) {
                            swal("Error", response.massage, "error");
                            console.log($('#' + itemId).val());
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/backend/setting/home/index.blade.php ENDPATH**/ ?>