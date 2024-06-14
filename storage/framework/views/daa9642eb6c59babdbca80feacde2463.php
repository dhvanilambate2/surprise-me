<div class="iconsidebar-menu">
    <div class="sidebar">
        <ul class="iconMenu-bar custom-scrollbar">
            <li>
                <a class="bar-icons" href="#">
                    <i class="pe-7s-home"></i><span> Home </span>
                </a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Dashboard</li>
                    <li><a href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
                </ul>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categories-list')): ?>
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Categories</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Categories</li>
                        <li><a href="<?php echo e(route('categories.index')); ?>">Categories</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('services-list')): ?>
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Services</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Services</li>
                        <li><a href="<?php echo e(route('services.index')); ?>">Services</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['vendors-list', 'vendors-shop-list'])): ?>
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-users"></i><span>Vendors</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Vendors</li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendors-list')): ?>
                            <li><a href="<?php echo e(route('vendors.index')); ?>">Vendor Details</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendors-shop-list')): ?>
                            <li><a href="<?php echo e(route('vendor_shop.index')); ?>">Vendor Shop Details</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <li>
                <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Users</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Manage Users</li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users-list')): ?>
                        <li><a href="<?php echo e(url('admin/users')); ?>">Users Details</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users-create')): ?>
                        <li><a href="<?php echo e(route('users.create')); ?>">Add Users</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles-list')): ?>
                        <li><a href="<?php echo e(route('roles.index')); ?>">Manage Roles</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-list')): ?>
                        <li><a href="<?php echo e(route('permissions.index')); ?>">Manage Permission</a></li>
                    <?php endif; ?>
                </ul>
            </li>
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
</div>
<?php /**PATH /home3/justdigi/surprise-me.justdigitalgurus.com/resources/views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>