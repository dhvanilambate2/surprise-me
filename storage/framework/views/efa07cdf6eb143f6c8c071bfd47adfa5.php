<?php $__env->startSection('title', 'Vendors Shops'); ?>

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
    <h2>Data of <span>Vendor Shop</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Vendor</li>
    <li class="breadcrumb-item">Vendor Shop Details</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Vendor Shop Details</h5>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendors-shop-create')): ?>
                                <a href="<?php echo e(route('vendor_shop.create')); ?>"><button class="btn btn-primary btn-sm ">Add Vendor
                                        Shop</button></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body add-post">
                        <div class="table-responsive">
                            <table class="table" id="publish-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="text-nowrap">Shop Name</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $vendorShops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($item->id); ?></th>
                                            <td><?php echo e($item->shop_name); ?></td>
                                            <td class="truncate-text"><?php echo e($item->user->name); ?></td>
                                            <td class="truncate-text"><?php echo e($item->category->name); ?></td>
                                            <td class="truncate-text"><?php echo e($item->phone); ?></td>


                                            <td class="text-nowrap">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendors-edit')): ?>
                                                    <a href="<?php echo e(route('vendor_shop.edit', $item->id)); ?>"><button
                                                            class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                                <?php endif; ?>
                                                <!-- Button trigger modal -->
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendors-delete')): ?>
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

                                                                
                                                                <form action="<?php echo e(route('vendor_shop.destroy', $item->id)); ?>"
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







<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/backend/vendor_shop/index.blade.php ENDPATH**/ ?>