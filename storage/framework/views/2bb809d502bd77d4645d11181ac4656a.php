<?php $__currentLoopData = $homeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($item->status == 'review'): ?>
        <tr>
            <th scope="row"><?php echo e($item->id); ?></th>
            <td><?php echo e($item->property_name); ?></td>
            <td class="truncate-text"><?php echo e($item->address); ?>

            </td>
            <td class="truncate-text">
            <!-- Add a dropdown for the 'Status' column -->
            <select class="form-control form-control-sm"
            onchange="updateStatus(this, <?php echo e($item->id); ?>)">
            <option value="publish"
            <?php echo e($item->status == 'publish' ? 'selected' : ''); ?>>
            Publish
            </option>
            <option value="rent"
            <?php echo e($item->status == 'rent' ? 'selected' : ''); ?>>
            Rent</option>
            <option value="archive"
            <?php echo e($item->status == 'archive' ? 'selected' : ''); ?>>
            Archive
            </option>
            <option value="draft"
            <?php echo e($item->status == 'draft' ? 'selected' : ''); ?>>
            Draft
            </option>
            <option value="review"
            <?php echo e($item->status == 'review' ? 'selected' : ''); ?>>
            Ready for review
            </option>
            </select>
            </td>
            <td class="truncate-text">
            <span
            class="badge badge-pill <?php echo e($class); ?>"><?php echo e($badge_name); ?></span>
            </td>
            <td><?php echo e($item->created_at); ?></td>
            <td><?php echo e($item->updated_at); ?></td>
            <!--<td class="text-center">-->
            <!--    <input class="current-project-checkbox" data-item-id="<?php echo e($item->id); ?>" type="checkbox" <?php echo e($item->current_project == '1' ? 'checked' : ''); ?>>-->
            <!--</td>-->
            <td class="text-nowrap">
            <a href="<?php echo e(route('home_for_rent.details', ['id' => $item->id])); ?>"
            target="_blank">
            <button
            class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
            </a>
            <a
            href="<?php echo e(route('home_for_rent.edit', $item->id)); ?>">
            <button
            class="btn btn-shadow-primary btn-sm">Edit</button>
            </a>
            <!-- Button trigger modal -->
            <button class="btn text-danger px-2"
            type="button" data-toggle="modal"
            data-original-title="test"
            data-target="#exampleModal<?php echo e($item->id); ?>">
            <i data-feather="trash-2"></i>
            </button>
            <div class="modal fade"
            id="exampleModal<?php echo e($item->id); ?>"
            tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel">
                        Confirm Deletion</h5>
                    <button class="close"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete
                    this record?
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-secondary"
                        type="button"
                        data-dismiss="modal">Cancel</button>

                    
                    <form
                        action="<?php echo e(route('home_for_sale.destroy', $item->id)); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                            class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            </div>
            <!-- Modal -->
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/rent/table_body.blade.php ENDPATH**/ ?>