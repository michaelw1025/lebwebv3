
<nav class="col-4 col-xs-3 col-sm-2 bg-light flex-column p-0">
    <ul class="nav">
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $notificationArray) ? 'bg-white' : ''}}">
            <a href="{{Route('user-notifications')}}" class="nav-link {{in_array(Route::currentRouteName(), $notificationArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-bullhorn fa-lg {{$userNotifications->isEmpty() ? '' : 'text-danger'}} sidebar-icon"></i><span class="d-none d-lg-inline-block">Notifications</span></a>
        </li>
        @if(Auth::user()->hasAnyRole(['admin']))
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $usersNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('users.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $usersNavArray) ? 'text-primary' : 'text-dark'}}"><i class="far fa-address-book fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Users</span>
            </a>
        </li>
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'bg-white' : ''}}">
            <a href="{{Route('roles.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $rolesNavArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-shield-alt fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Roles</span>
            </a>
        </li>
        @endif
        @if(Auth::user()->hasAnyRole(['admin', 'hrmanager', 'hruser', 'hrassistant']))
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $employeesNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $employeesNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Employee</span></a>
            <div class="dropdown-menu">
                <a href="{{Route('employees.create')}}" class="dropdown-item">Add New</a>
                <div class="dropdown-divider"></div>
                <a href="{{Route('employees.index', ['type' => 'active'])}}" class="dropdown-item">Search Active</a>
                <a href="{{Route('employees.index', ['type' => 'inactive'])}}" class="dropdown-item">Search Inactive</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $queriesNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $queriesNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Queries</span></a>
            <div class="dropdown-menu">
                <a href="{{Route('queries.employee-alphabetical-hourly')}}" class="dropdown-item">Employee Alphabetical Hourly</a>
                <a href="{{Route('queries.employee-alphabetical-salary')}}" class="dropdown-item">Employee Alphabetical Salary</a>
                <a href="{{Route('queries.employee-seniority')}}" class="dropdown-item">Employee Seniority</a>
                <a href="{{Route('queries.employee-birthday')}}" class="dropdown-item">Employee Birthday</a>
                <a href="{{Route('queries.employee-anniversary-by-month')}}" class="dropdown-item">Employee Anniversary By Month</a>
                <a href="{{Route('queries.employee-anniversary-by-quarter')}}" class="dropdown-item">Employee Anniversary By Quarter</a>
                <a href="{{Route('queries.employee-wage-progression')}}" class="dropdown-item">Employee Wage Progression</a>
                <a href="{{Route('queries.employee-cost-center-all')}}" class="dropdown-item">Cost Center - All</a>
                <a href="{{Route('queries.employee-cost-center-individual')}}" class="dropdown-item">Cost Center - Individual</a>
                <a href="{{Route('queries.employee-disciplinary-all')}}" class="dropdown-item">Employee Disciplinary All</a>
                <a href="{{Route('queries.employee-review')}}" class="dropdown-item">Employee Review</a>
                <a href="{{Route('queries.employee-reduction')}}" class="dropdown-item">Employee Reduction</a>
                <a href="{{Route('queries.employee-turnover-hourly')}}" class="dropdown-item">Employee Turnover - Hourly</a>
                <a href="{{Route('queries.employee-turnover-salary')}}" class="dropdown-item">Employee Turnover - Salary</a>
                <a href="{{Route('queries.employee-hire-date-hourly')}}" class="dropdown-item">Employee Hire Date - Hourly</a>
                <a href="{{Route('queries.employee-hire-date-salary')}}" class="dropdown-item">Employee Hire Date - Salary</a>
                <a href="{{Route('queries.employee-bonus-hours')}}" class="dropdown-item">Employee Bonus Hours</a>
                <a href="{{Route('queries.employee-team-leader')}}" class="dropdown-item">Team Leader</a>
            </div>
        </li>
        <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $manageNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $manageNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Manage</span></a>
            <div class="dropdown-menu">
                <a href="{{Route('costCenters.index')}}" class="dropdown-item">Cost Centers</a>
                <a href="{{Route('jobs.index')}}" class="dropdown-item">Jobs</a>
                <a href="{{Route('positions.index')}}" class="dropdown-item">Positions</a>
                <a href="{{Route('shifts.index')}}" class="dropdown-item">Shifts</a>
                <a href="{{Route('wageProgressions.index')}}" class="dropdown-item">Wage Progressions</a>
                <a href="{{Route('wageTitles.index')}}" class="dropdown-item">Wage Titles</a>
                <a href="{{Route('teams.index')}}" class="dropdown-item">Teams</a>
            </div>
        </li>
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'bg-white' : ''}}">
            <a href="{{route('bids.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-receipt fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Bidding</span>
            </a>
        </li>
        <!-- <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $biddingNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-receipt fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Bidding</span></a>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item">Add New</a>
            </div>
        </li> -->
        <!-- <li class="nav-item dropdown w-100 {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary bg-white' : 'text-dark'}}">
            <a href="{{Route('users.index')}}" class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary' : 'text-dark'}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-clipboard-check fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Contractors</span></a>
            <div class="dropdown-menu">
            <a href="{{Route('contractors.index')}}" class="dropdown-item">Company</a>
            <a href="{{Route('contractorTrainings.index')}}" class="dropdown-item">Employee</a>
            </div>
        </li> -->
        <li class="nav-item w-100 {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary bg-white' : ''}}">
            <a href="{{Route('contractors.index')}}" class="nav-link {{in_array(Route::currentRouteName(), $contractorsNavArray) ? 'text-primary' : 'text-dark'}}"><i class="fas fa-clipboard-check fa-lg sidebar-icon"></i><span class="d-none d-lg-inline-block">Contractors</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
