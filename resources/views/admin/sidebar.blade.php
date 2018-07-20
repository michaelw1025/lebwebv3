<!-- <nav class="col-2 bg-dark">
    <ul class="nav mt-2 bg-light">
        <li class="nav-item">
            <a href="" class="nav-link p-0 text-light bg-warning">Users</a>
        </li>
    </ul>
</nav> -->

<nav class="nav col-2 bg-light flex-column p-0">
    <a class="nav-link {{in_array(Route::currentRouteName(), array('users.index', 'users.show')) ? 'text-Primary bg-white' : 'text-dark'}}" href="{{Route('users.index')}}"><i class="far fa-id-card fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspUsers</span></a>
    <a class="nav-link text-dark" href=""><i class="fas fa-shield-alt fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspRoles</span></a>
</nav>