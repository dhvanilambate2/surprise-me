 <style>
     .top-0{
         top: 0;
     }
     .right-0{
         right: 0;
     }
     .btn-close{
         opacity: 1 !important;
     }
 </style>
 
<?php
    $count = 01;
?>
<?php if(count($homeDetails) > 0): ?>
    <?php $__currentLoopData = $homeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-4 col-md-6 ">
            <div class="gallery-box position-relative">
                <?php if($item->home_for == 'rent'): ?>
                    <a href="<?php echo e(route('home_for_rent.details', ['id' => $item->id])); ?>">
                <?php else: ?>
                    <a href="<?php echo e(route('home_for_sale.details', ['id' => $item->id])); ?>">
                <?php endif; ?>
                
                    <div class="project-img">
                        <?php if($item->main_image): ?>
                            <img src="<?php echo e(asset('public/images/' . $item->main_image)); ?>" alt="Main Image Preview" style="width: 100%;height: 450px; object-fit:cover;">
                        <?php endif; ?>
                    </div>
                    <div class="gallery-content">
                        <?php if($count > 9): ?>
                            <div class="project-number"><?php echo e($count); ?></div>
                        <?php else: ?>
                            <div class="project-number">0<?php echo e($count); ?></div>
                        <?php endif; ?>
                        <h3 class="h5 project-title"><?php echo e($item->property_name); ?></h3>
                        <p class="project-map"><i class="fal fa-location-dot"></i><?php echo e($item->address); ?></p>
                    </div>
                </a>
            <button type="button" class="btn-close bg-dark text-light fs-1 position-absolute top-0 right-0 rounded-circle p-1 m-2 openModal"  data-model-id="<?php echo e($item->id); ?>"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
        
            <div class="modal fade" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inquireModalLabel">Remove Form Wishlist</h5>
                        <button type="button" class="btn-close text-light fs-1" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to remove Item form Wishlist</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="th-btn removeWishlist" id="" data-property-id="<?php echo e($item->id); ?>" ><span class="line left"></span> Remove <span class="line"></span></button>
                     </div>
                </div>
            </div>
        </div>
        <?php
            $count++
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <div class="d-flex justify-content-center mt-5">
                <?php echo e($homeDetails->links()); ?>

        </div>
<?php else: ?> 
    <h3 class="text-light text-center">Not Found..!!</h3>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function openRemoveModal(modelId) {
            $('#exampleModal'+ modelId).modal('show');
    }
    $('.openModal').click(function() {
         var modelId = $(this).data('model-id');
        openRemoveModal(modelId);
    });
    
    $(document).ready(function() {
         $('.removeWishlist').click(function(e) {
            e.preventDefault(); 
            var propertyId = $(this).data('property-id');
            
            $.ajax({
                url: "<?php echo e(route('wishlist.destroy', ':id')); ?>".replace(':id', propertyId),
                method: 'DELETE', 
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>" 
                },
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        if (response.success) {
                             $('#exampleModal' + propertyId).modal('hide');
                            swal("Success", response.message, "success").then((value) => {
                                window.location.reload(); // Reload the page after dismissing the SweetAlert
                            });
                        } else if (response.error) {
                            swal("Error", response.message, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        });
    });
        
</script>
<?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/wishlistData.blade.php ENDPATH**/ ?>