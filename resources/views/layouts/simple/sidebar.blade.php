<div class="iconsidebar-menu">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="#">
               <i class="pe-7s-home"></i><span> Home   </span>
            </a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Dashboard</li>
               <li><a href="{{url('admin/dashboard')}}">Home</a></li>
            </ul>
         </li>
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Users</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Manage Users</li>
               <li><a href="{{url('admin/users')}}">Users Details</a></li>
               <li><a href="{{route('users.create')}}">Add Users</a></li>
               @can('roles-list')
                  <li><a href="{{route('roles.index')}}">Manage Roles</a></li>
               @endcan
               <li><a href="{{route('permissions.index')}}">Manage Permission</a></li>
            </ul>
         </li>
       
      </ul>
   </div>
</div>