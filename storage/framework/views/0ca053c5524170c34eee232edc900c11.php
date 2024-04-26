<div class="page-main-header">
  <div class="main-header-right">
    <div class="main-header-left text-center">
      <div class="logo-wrapper"><a href="<?php echo e(route('/')); ?>"><img src="<?php echo e(route('/')); ?>/assets/images/logo/logo.png" alt="" class=""></a></div>
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
      </div>
    </div>
    <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar">               </i></div>
    <div class="nav-right col pull-right right-menu d-flex justify-content-end">
      <ul class="nav-menus">
        

        <li class="onhover-dropdown w-100"> <span class="media user-header"><img class="img-fluid" src="<?php echo e(route('/')); ?>/assets/images/dashboard/user.png" style="width: 100px" alt=""></span>
          <ul class="onhover-show-div profile-dropdown">
            <li class="gradient-primary">
              <h5 class="f-w-600 mb-0"><?php echo e(Auth::user()->name); ?></h5><span><?php echo e(Auth::user()->role); ?></span>
            </li>
            <li><a href="<?php echo e(url("admin/profile")); ?>" class="text-decoration-none text-dark"><i data-feather="user"> </i>Profile</a></li>
            <li><a href="<?php echo e(url("admin/setting_site")); ?>" class="text-decoration-none text-dark"><i data-feather="settings"> </i>Settings  </a>          </li>
            <li><a href="<?php echo e(route('logout')); ?>" class="text-decoration-none text-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i>Logout</a></li>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
              <?php echo csrf_field(); ?>
          </form>
          </ul>
        </li>
      </ul>
      <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
    </div>
    <script id="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
      <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
      <div class="ProfileCard-details">

      </div>
      </div>
    </script>
    <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div><?php /**PATH F:\raj\gaia\resources\views/layouts/simple/header.blade.php ENDPATH**/ ?>