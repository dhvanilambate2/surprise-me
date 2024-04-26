<?php if($paginator->hasPages()): ?>
    <style>
        .active span{
            background-color: #eebd42;
        }
        .page-link:focus, .page-link:hover {
            background-color: #eebd42;
            z-index: 3;
            outline: 0;
            box-shadow: none;
        }
    </style>
    <nav class="th-pagination">
        <ul>
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="d-none" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <span class="page-link p-0" aria-hidden="true">&lsaquo;</span>
                </li>
            <?php else: ?>
                <li class="">
                    <a class="page-link p-0" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">&lsaquo;</a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="" aria-disabled="true"><span class="page-link p-0"><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class=" active" aria-current="page"><span class="page-link p-0"><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li class=""><a class="page-link p-0" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="">
                    <a class="page-link p-0" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">&rsaquo;</a>
                </li>
           
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH F:\raj\gaia\vendor\laravel\framework\src\Illuminate\Pagination/resources/views/bootstrap-4.blade.php ENDPATH**/ ?>