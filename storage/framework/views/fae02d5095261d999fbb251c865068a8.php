<?php $__env->startSection('title', 'Services'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .truncate-text {
            max-width: 150px;
            /* Adjust the maximum width according to your design */
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
    <h2>Data of <span>Services</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Services</li>
    <li class="breadcrumb-item">Services Details</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Services Details</h5>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services-create')): ?>
                            <a href="<?php echo e(route('services.create')); ?>"><button class="btn btn-primary btn-sm ">Add
                                    Services</button></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body add-post">
                        <div class="table-responsive">
                            <table class="table" id="publish-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="text-nowrap">Service Name</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Change Status</th>
                                        <th scope="col">status</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            switch ($item->status) {
                                                case 'draft':
                                                    $class = 'badge-light';
                                                    $badge_name = 'Draft';
                                                    break;
                                                case 'review':
                                                    $class = 'badge-danger';
                                                    $badge_name = 'Ready For Review';
                                                    break;
                                                case 'publish':
                                                    $class = 'badge-success';
                                                    $badge_name = 'Published';
                                                    break;
                                                default:
                                                    $class = 'badge-light';
                                                    $badge_name = 'Unknown';
                                                    break;
                                            }
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo e($item->id); ?></th>
                                            <td><?php echo e($item->service_name); ?></td>
                                            <td class="truncate-text"><?php echo e($item->user->name); ?></td>
                                            <td class="truncate-text"><?php echo e($item->category->name); ?></td>
                                            <td class="truncate-text">
                                                <!-- Add a dropdown for the 'Status' column -->
                                                <select class="form-control form-control-sm"
                                                    onchange="updateStatus(this, <?php echo e($item->id); ?>)">
                                                    <option value="draft" <?php echo e($item->status == 'draft' ? 'selected' : ''); ?>>
                                                        Draft</option>
                                                    <option value="review"
                                                        <?php echo e($item->status == 'review' ? 'selected' : ''); ?>>Ready For Review
                                                    </option>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services-publish')): ?>
                                                        <option value="publish"
                                                        <?php echo e($item->status == 'publish' ? 'selected' : ''); ?>>Publish</option>
                                                    <?php endif; ?>
                                                </select>
                                            </td>

                                            <td class="truncate-text" id="status"><span
                                                    class="badge badge<?php echo e($item->id); ?> badge-pill <?php echo e($class); ?>"><?php echo e($badge_name); ?></span>
                                            </td>

                                            <td class="truncate-text"><?php echo e($item->price); ?></td>


                                            <td class="text-nowrap">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services-edit')): ?>

                                                <a href="<?php echo e(route('services.edit', $item->id)); ?>"><button
                                                        class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                            <?php endif; ?>
                                                        <!-- Button trigger modal -->
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services-delete')): ?>

                                                <button class="btn text-danger px-2" type="button" data-toggle="modal"
                                                    data-original-title="test"
                                                    data-target="#exampleModal<?php echo e($item->id); ?>"><i
                                                        data-feather="trash-2"></i></button>
                                            <?php endif; ?>

                                                <div class="modal fade" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Confirm
                                                                    Deletion</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cancel</button>

                                                                
                                                                <form action="<?php echo e(route('services.destroy', $item->id)); ?>"
                                                                    method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
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
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>
        function updateStatus(selectElement, itemId) {
            var newStatus = selectElement.value;
            // Log the selected value to the console
            console.log("Selected Status:", newStatus);

            // Make an AJAX request to update the status in the database
            $.ajax({
                url: "<?php echo e(route('admin.services.update_status', ['id' => '__itemId__'])); ?>".replace(
                    '__itemId__', itemId),
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    status: newStatus
                },
                success: function(response) {

                    // Handle success (optional)

                    // Update the UI (as in your original code)
                    // Use jQuery to remove classes
                    $('.badge' + itemId).removeClass(
                        'badge-success badge-warning badge-secondary badge-light badge-danger');

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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/backend/services/index.blade.php ENDPATH**/ ?>