<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col" class="d-none d-lg-table-cell">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="toggle-hire-date">Hire Date</th>
            <th scope="col" class="toggle-shift">Shift</th>
            <th scope="col" class="toggle-cost-center">Cost Center</th>
            <th scope="col" class="toggle-team-manager">Team Manager</th>
            <th scope="col" class="toggle-team-leader">Team Leader</th>
        </tr>
    </thead>
    <tbody>
    @php
    $reviewTypes = array('thirty_day_review', 'sixty_day_review');
    @endphp
        @foreach($reviewTypes as $reviewType)
        <tr class="bg-info text-center"><td colspan="8">{{$reviewType == 'thirty_day_review' ? '30 Day Review' : '60 Day Review'}}</td></tr>
        @foreach($employees as $employee)
        @if($employee->$reviewType == 0)
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            @if($employee->shift->count() > 0)
                @foreach($employee->shift as $shift)
                <td class="toggle-shift">{{$shift->description}}</td>
                @endforeach
            @else
                <td class="toggle-shift text-danger">Not Set</td>
            @endif
            @if($employee->costCenter->count() > 0)
                @foreach($employee->costCenter as $costCenter)
                <td class="toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                @endforeach
            @else
            <td class="toggle-cost-center text-danger">Not Set</td>
            @endif
            <td class="toggle-team-manager">{{$employee->team_manager}}</td>
            <td class="toggle-team-leader">{{$employee->team_leader}}</td>
        </tr>
        @endif
        @endforeach
        @endforeach
    </tbody>
</table>