<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col" class="d-none d-xxl-table-cell">ID</th>
            <th scope="col" class="toggle-first-name">Name</th>
            <th scope="col" class="toggle-ssn">SSN</th>
            <th scope="col" class="toggle-oracle-number">Oracle Number</th>
            <th scope="col" class="toggle-hire-date">Hire Date</th>
            <th scope="col" class="toggle-progression-date">Progression Date</th>
            <th scope="col" class="toggle-shift">Shift</th>
            <th scope="col" class="toggle-cost-center">Cost Center</th>
            <th scope="col" class="toggle-position">Position</th>
            <th scope="col" class="toggle-current-wage">Current Wage</th>
            <th scope="col" class="toggle-next-wage">Next Wage</th>
            <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
            <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wageProgressions as $wageProgression)
        @continue($wageProgression->month == 0)
        <tr class="bg-info text-center"><td colspan="15">{{$wageProgression->month}} Month Progression</td></tr>
        
        @foreach($employees as $employee)
        @foreach($employee->wageProgression as $employeeWageProgression)
        @if($employeeWageProgression->id === $wageProgression->id)
        
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td class="d-none d-xxl-table-cell">{{$employee->id}}</td>
            <td class="toggle-first-name">{{$employee->first_name}} {{$employee->middle_initial}} {{$employee->last_name}}</td>
            <td class="toggle-ssn"><span class="d-inline-block">{{$employee->ssn}}</span></td>
            <td class="toggle-oracle-number">{{$employee->oracle_number}}</td>
            <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            <td class="toggle-progression-date">{{$employeeWageProgression->pivot->date->format('m/d/Y')}}</td>
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
            @if($employee->position->count() > 0)
                @foreach($employee->position as $position)
                <td class="toggle-position">{{$position->description}}</td>
                @endforeach
            @else
                <td class="toggle-position text-danger">Not Set</td>
            @endif
            <td class="toggle-current-wage">{{$employee->current_wage}}</td>
            <td class="toggle-next-wage">{{$employee->next_wage}}</td>
            <td class="d-none toggle-team-manager">{{$employee->team_manager}}</td>
            <td class="d-none toggle-team-leader">{{$employee->team_leader}}</td>
        </tr>
        @endif
        @endforeach
        @endforeach

        @endforeach
    </tbody>
</table>