 <?php
$count = 01;
?>
<?php if(count($homeDetails) > 0): ?>
    <?php $__currentLoopData = $homeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-4 col-md-6">
            <div class="gallery-box">
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
<?php endif; ?><?php /**PATH F:\raj\gaia\resources\views/frontend/homeData.blade.php ENDPATH**/ ?>