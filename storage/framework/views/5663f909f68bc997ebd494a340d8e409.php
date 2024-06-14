<?php $__env->startSection('title', 'Permissions List'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
   .truncate-text {
       max-width: 150px; /* Adjust the maximum width according to your design */
       white-space: nowrap;
       overflow: hidden;
       text-overflow: ellipsis;
   }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
	<h2>Permissions<span>List</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
   <li class="breadcrumb-item">Permission</li>
   <li class="breadcrumb-item active">Permissions List</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5>Permission</h5>
               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-create')): ?>
               <a href="<?=route('permissions.create')?>"><button class="btn btn-primary btn-sm ">Add Permission</button></a>
               <?php endif; ?>
            </div>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-nowrap">Name</th>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['permission-edit', 'permission-delete'])): ?>
               <th scope="col">Action</th>
               <?php endif; ?>

                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <th scope="row"><?php echo e($item->id); ?></th>
                        <td class="truncate-text"><?php echo e($item->name); ?></td>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['permission-edit', 'permission-delete'])): ?>

                       <td class="text-nowrap">
                              <!--<a href=""><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a>-->
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-edit')): ?>
                           <a href="<?php echo e(route('permissions.edit', $item->id)); ?>"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                           <?php endif; ?>
                              <!-- Button trigger modal -->
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-delete')): ?>
                              <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal<?php echo e($item->id); ?>"><i data-feather="trash-2"></i></button>
                           <?php endif; ?>
                              <div class="modal fade" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                          </div>
                                          <div class="modal-body">
                                                Are you sure you want to delete this record?
                                          </div>
                                          <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                                <!-- Form for calling the destroy method -->
                                                <form action="<?php echo e(route('permissions.destroy', $item->id)); ?>" method="POST">
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
                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/backend/permissions/index.blade.php ENDPATH**/ ?>