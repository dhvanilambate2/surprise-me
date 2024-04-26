<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

 <div class="table-responsive">
                        <table class="table" id="publish-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-nowrap">Number</th>
                                    <?php if($currentTab != "contact"): ?>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <?php endif; ?>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
            <?php $__currentLoopData = $inquiriesDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($item->id); ?></th>
                    <td><?php echo e($item->name); ?></td>
                    <td class="truncate-text"><?php echo e($item->email); ?></td>
                    <td class=""><?php echo e($item->number); ?></td>
                    <?php if($currentTab != "contact"): ?>
                    <td class="">
                        <?php if($item->HomeDetails->home_for == 'rent'): ?>
                            <a href="<?php echo e(route('home_for_rent.details', $item->HomeDetails->id)); ?>" target="_blank"><?php echo e($item->HomeDetails->property_name); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(route('home_for_sale.details', $item->HomeDetails->id)); ?>" target="_blank"><?php echo e($item->HomeDetails->property_name); ?></a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td class="text-nowrap">
                           <a href="<?php echo e(route('inquiries.show', $item->id)); ?>"><button
                                 class="btn btn-shadow-secondary btn-sm px-3">View </button></a>
                           <!-- Button trigger modal -->
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inquiries-delete')): ?>
                           <button class="btn text-danger px-2" type="button" data-toggle="modal"
                              data-original-title="test" data-target="#exampleModal<?php echo e($item->id); ?>"><i
                                 data-feather="trash-2"></i></button>
                                 <?php endif; ?>
                           <div class="modal fade" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                             aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                       Are you sure you want to delete this record?
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" type="button"
                                          data-dismiss="modal">Cancel</button>

                                       
                                       <form action="<?php echo e(route('inquiries.destroy', $item->id)); ?>" method="POST">
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


<script>
    feather.replace();
</script><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/inquiries/table_content.blade.php ENDPATH**/ ?>