<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col" class="d-none d-lg-table-cell">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="toggle-birth-date">Birth Date</th>
            <th scope="col" class="d-none toggle-hire-date">Hire Date</th>
            <th scope="col" class="d-none toggle-shift">Shift</th>
            <th scope="col" class="d-none toggle-job">Job</th>
            <th scope="col" class="d-none toggle-position">Position</th>
            <th scope="col" class="d-none toggle-cost-center">Cost Center</th>
            <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
            <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="toggle-birth-date">{{$employee->birth_date->format('m/d/Y')}}</td>
            <td class="d-none toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            @if($employee->shift->count() > 0)
                @foreach($employee->shift as $shift)
                <td class="d-none toggle-shift">{{$shift->description}}</td>
                @endforeach
            @else
                <td class="d-none toggle-shift text-danger">Not Set</td>
            @endif
            @if($employee->job->count() > 0)
                @foreach($employee->job as $job)
                <td class="d-none toggle-job">{{$job->description}}</td>
                @endforeach
            @else
                <td class="d-none toggle-job text-danger">Not Set</td>
            @endif
            @if($employee->position->count() > 0)
                @foreach($employee->position as $position)
                <td class="d-none toggle-position">{{$position->description}}</td>
                @endforeach
            @else
                <td class="d-none toggle-position text-danger">Not Set</td>
            @endif
            @if($employee->costCenter->count() > 0)
                @foreach($employee->costCenter as $costCenter)
                <td class="d-none toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                @endforeach
            @else
            <td class="d-none toggle-cost-center text-danger">Not Set</td>
            @endif
            <td class="d-none toggle-team-manager">{{$employee->team_manager}}</td>
            <td class="d-none toggle-team-leader">{{$employee->team_leader}}</td>
        </tr>
        @endforeach
    </tbody>
</table>