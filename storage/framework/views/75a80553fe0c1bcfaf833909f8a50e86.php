<div class="iconsidebar-menu">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="#">
               <i class="pe-7s-home"></i><span> Home   </span>
            </a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Dashboard</li>
               <li><a href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
            </ul>
         </li>
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Users</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Manage Users</li>
               <li><a href="<?php echo e(url('admin/users')); ?>">Users Details</a></li>
               <li><a href="<?php echo e(route('users.create')); ?>">Add Users</a></li>
               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles-list')): ?>
                  <li><a href="<?php echo e(route('roles.index')); ?>">Manage Roles</a></li>
               <?php endif; ?>
               <li><a href="<?php echo e(route('permissions.index')); ?>">Manage Permission</a></li>
            </ul>
         </li>
       
      </ul>
   </div>
</div><?php /**PATH F:\raj\surprise_me\resources\views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>