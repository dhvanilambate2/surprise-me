<div class="iconsidebar-menu">
    <div class="sidebar">
        <ul class="iconMenu-bar custom-scrollbar">
            <li>
                <a class="bar-icons" href="#">
                    <i class="pe-7s-home"></i><span> Home </span>
                </a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Dashboard</li>
                    <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
                </ul>
            </li>
            @can('categories-list')
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Categories</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Categories</li>
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                    </ul>
                </li>
            @endcan
            @can('services-list')
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Services</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Services</li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                    </ul>
                </li>
            @endcan
            @canany(['vendors-list', 'vendors-shop-list'])
                <li>
                    <a class="bar-icons" href="#"><i class="pe-7s-users"></i><span>Vendors</span></a>
                    <ul class="iconbar-mainmenu custom-scrollbar">
                        <li class="iconbar-header">Manage Vendors</li>
                        @can('vendors-list')
                            <li><a href="{{ route('vendors.index') }}">Vendor Details</a></li>
                        @endcan
                        @can('vendors-shop-list')
                            <li><a href="{{ route('vendor_shop.index') }}">Vendor Shop Details</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            <li>
                <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Users</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Manage Users</li>
                    @can('users-list')
                        <li><a href="{{ url('admin/users') }}">Users Details</a></li>
                    @endcan
                    @can('users-create')
                        <li><a href="{{ route('users.create') }}">Add Users</a></li>
                    @endcan
                    @can('roles-list')
                        <li><a href="{{ route('roles.index') }}">Manage Roles</a></li>
                    @endcan
                    @can('permission-list')
                        <li><a href="{{ route('permissions.index') }}">Manage Permission</a></li>
                    @endcan
                </ul>
            </li>
            <li>
                <a class="bar-icons" href="#"><i class="pe-7s-settings"></i><span>Setting</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                    <li class="iconbar-header">Manage Site Setting</li>
                    <li><a href="{{ route('setting_home.index') }}">Home Page</a></li>
                    <li><a href="{{ route('setting_site.index') }}">Site Setting</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
