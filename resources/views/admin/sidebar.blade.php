<!-- Admin sidebar -->
<nav class="col-4 col-xs-3 col-sm-2 bg-light flex-column p-0">
    <ul class="nav">
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $usersNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('users.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $usersNavArray) ? 'text-primary' : 'text-dark'}}"><i class="far fa-address-book fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Users</span>
            </a>
        </li>
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('roles.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-shield-alt fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Roles</span>
            </a>
        </li>
        @include('components.notifications')
    </ul>
</nav>
