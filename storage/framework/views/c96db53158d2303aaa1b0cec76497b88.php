<?php $__env->startSection('content'); ?>
<style>
    #profile_card:hover {
        cursor: pointer;
    }
</style>
<!--==============================
    Breadcumb
============================== -->
<div class="">
    <div class="breadcumb-wrapper mt-4 " data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/team.png">
        <h1 class="breadcumb-title">Our Experts</h1>
        <ul class="breadcumb-menu d-none">
            <li><a href="index.html">Home</a></li>
            <li>Our Expert</li>
        </ul>
    </div>
</div>
<!--==============================
Team Area  
==============================-->
<section class="space">
    <div class="container">
        <div class="row gy-30">
            <!-- Single Item -->
          
            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
        
                  <div class="team-card style2" id="profile_card" data-id="<?php echo e(route('team.details', ['id' => $team->id])); ?>">
                        <p class="team-desig"><?php echo e($team->post); ?></p>
                        <h3 class="h5 team-title"><a href="<?php echo e(route('team.details', ['id' => $team->id])); ?>"><?php echo e($team->name); ?></a></h3>
                        <div class="th-social">
                            <?php if($team->facebook): ?>
                                <a target="_blank" href="<?php echo e($team->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php if($team->skype): ?>
                                <a target="_blank" href="<?php echo e($team->skype); ?>"><i class="fab fa-skype"></i></a>
                            <?php endif; ?>
                            <?php if($team->twitter): ?>
                                <a target="_blank" href="<?php echo e($team->twitter); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="team-img">
                            <img src="<?php echo e($team->getFirstMediaUrl('teams')); ?>" alt="Team">
                        </div>
                    </div>
                   
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>


<script>
    document.getElementById('profile_card').addEventListener('click', function() {
        var url = this.getAttribute('data-id');
        window.location.href = url;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/teams.blade.php ENDPATH**/ ?>