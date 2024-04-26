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
            <a class="bar-icons" href="#"><i class="pe-7s-portfolio"></i><span>Properties
            </span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Manage</li>
               <li><a href="<?php echo e(url('admin/home_for_rent')); ?>">Homes For Rent</a></li>
               <li><a href="<?php echo e(url('admin/home_for_sale')); ?>">Homes For Sale</a></li>              
            </ul>
         </li>
        
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Blogs</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Manage Blogs</li>
               <li><a href="<?php echo e(url('admin/blogs')); ?>">Blog Details</a></li>
               <li><a href="<?php echo e(route('blogs.create')); ?>">Add Post</a></li>
               <li><a href="<?php echo e(route('blog_categories.index')); ?>">Blog Categories</a></li>
            </ul>
         </li>
         
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Users</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Manage Users</li>
               <li><a href="<?php echo e(url('admin/users')); ?>">Users Details</a></li>
               <li><a href="<?php echo e(route('users.create')); ?>">Add Users</a></li>
                <li><a href="<?php echo e(route('roles.index')); ?>">Manage Roles</a></li>
               <li><a href="<?php echo e(route('permissions.index')); ?>">Manage Permission</a></li>
            </ul>
         </li>
         
         <!--<li>-->
         <!--<span class="badge badge-pill badge-primary">New</span><a class="bar-icons" href="#"><i class="pe-7s-id"></i><span>Profile</span></a>-->
         <!--   <ul class="iconbar-mainmenu custom-scrollbar">-->
         <!--      <li class="iconbar-header">Manage Profile</li>-->
         <!--      <li><a href="<?php echo e(url('admin/profile')); ?>">Users Profile</a></li>-->
         <!--      <li><a href="<?php echo e(url('admin/profile/edit')); ?>">Users Edit</a></li>-->
         <!--   </ul>-->
         <!--</li>-->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inquiries-list')): ?>
               <li>
                  <a class="bar-icons" href="#"><i class="pe-7s-chat"></i><span>Enquiries</span></a>
                  <ul class="iconbar-mainmenu custom-scrollbar">
                     <li class="iconbar-header">Manage Enquiries</li>
                     <li><a href="<?php echo e(route('inquiries.index')); ?>">Enquiries Details</a></li>
                  </ul>
               </li>
               <?php endif; ?>
           <li>
              <a class="bar-icons" href="#"><i class="pe-7s-settings"></i><span>Setting</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Manage Site Setting</li>
                    <li><a href="<?php echo e(route('setting_home.index')); ?>">Home Page</a></li>
                    <li><a href="<?php echo e(route('setting_site.index')); ?>">Site Setting</a></li>
                </ul>
            </li>
      </ul>
   </div>
</div><?php /**PATH C:\laragon\www\stage\resources\views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>