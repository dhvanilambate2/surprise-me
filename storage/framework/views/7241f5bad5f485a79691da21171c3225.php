<?php $__env->startSection('title', 'Blog Details'); ?>

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
	<h2>Blog<span>Details</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
   <li class="breadcrumb-item">Blog</li>
   <li class="breadcrumb-item active">Blog Details</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5>Home For Rent</h5>
               <a href="<?= route('blogs.create') ?>"><button class="btn btn-primary btn-sm ">Add Blog</button></a>
            </div>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-nowrap">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="text-nowrap">Status</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php         
                        switch ($item->status) {
                              case "draft":
                                 $class = "badge-light";
                                 $badge_name = "Draft";
                                 break;
                              case "review":
                                 $class = "badge-danger";
                                 $badge_name = "Ready For Review";
                                 break;
                              case "publish":
                                 $class = "badge-success";
                                 $badge_name = "Published";
                                 break;
                        }
                     ?>
                     <tr>
                        <th scope="row"><?php echo e($item->id); ?></th>
                        <td class="truncate-text"><?php echo e($item->title); ?></td>
                        <td class=""><?php echo e($item->blogCategory->name); ?></td>
                        <td class=""><span class="badge badge-pill <?php echo e($class); ?>"><?php echo e($badge_name); ?></span></td>
                        <td class="text-nowrap">
                              <a href="<?php echo e(route('blog.details', ['id' => $item->id])); ?>"><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a>
                              <a href="<?php echo e(route('blogs.edit', $item->id)); ?>"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                              <!-- Button trigger modal -->
                              
                              <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal<?php echo e($item->id); ?>"><i data-feather="trash-2"></i></button>
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
                                                
                                                
                                                <form action="<?php echo e(route('blogs.destroy', $item->id)); ?>" method="POST">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/blog/index.blade.php ENDPATH**/ ?>