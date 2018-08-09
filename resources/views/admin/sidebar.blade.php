<!-- Admin sidebar -->

@php
    $usersNavArray = array('users.index', 'users.show', 'users.edit');
    $rolesNavArray = array('roles.index', 'roles.show', 'roles.edit', 'roles.create');
@endphp

<nav class="col-2 bg-light flex-column p-0">
    <ul class="nav">
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $usersNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('users.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $usersNavArray) ? 'text-primary' : 'text-dark'}}"><i class="far fa-address-book fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspUsers</span>
            </a>
        </li>
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('roles.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-shield-alt fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspRoles</span>
            </a>
        </li>
        @include('components.notifications')
    </ul>
</nav>
