<!-- HE sidebar -->

@php
    $employeesNavArray = array('employees.index', 'employees.create', 'employees.show', 'employees.edit');
    $queriesNavArray = array();
    $manageNavArray = array();
    $biddingNavArray = array();
    $contractorsNavArray = array();
@endphp

<nav class="col-2 bg-light flex-column p-0">
    <ul class="nav">
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $employeesNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $employeesNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspEmployees</span></a>
            <div class="dropdown-menu">
                <a href="{{Route('employees.create')}}" class="dropdown-item">Add New</a>
                <div class="dropdown-divider"></div>
                <a href="{{Route('employees.index', ['type' => 'active'])}}" class="dropdown-item">Search Active</a>
                <a href="{{Route('employees.index', ['type' => 'inactive'])}}" class="dropdown-item">Search Inactive</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $queriesNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $queriesNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspQueries</span></a>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item">Add New</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $manageNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $manageNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspManage</span></a>
            <div class="dropdown-menu">
                <a href="{{Route('costCenters.index')}}" class="dropdown-item">Cost Center</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-receipt fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspBidding</span></a>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item">Add New</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-tag fa-lg"></i><span class="d-none d-md-inline-block">&nbsp&nbspContractors</span></a>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item">Add New</a>
            </div>
        </li>
    </ul>
</nav>

<!-- <nav class="col-2 bg-light flex-column p-0">
    <ul class="nav col p-0 mt-2">
        <li class="nav-item dropdown col p-0">
            <a href="" class="row p-0 m-0" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="col col-md-2 p-0 text-center fas fa-users lead">&nbsp<i class="fas fa-caret-down d-md-none "></i></i><span class="d-none d-md-block col-md-10 p-0">Employees <i class="fas fa-caret-down"></i></span></a>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item">Add New</a>
                <div class="dropdown-divider"></div>
                <a href="{{Route('employees.index')}}" class="dropdown-item">Search Active</a>
                <a href="" class="dropdown-item">Search Inactive</a>
            </div>
        </li>
    </ul>
</nav> -->

