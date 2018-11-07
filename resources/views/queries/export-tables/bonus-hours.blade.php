<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="toggle-hire-date">Hire Date</th>
            <th scope="col" class="toggle-cost-center">Cost Center</th>
            <th scope="col" class="toggle-shift">Shift</th>
            <th scope="col" class="toggle-team-leader">Team Leader</th>
            <th scope="col">Disciplinaries</th>

        </tr>
    </thead>
    <tbody>
    @php
    $bonusYears = array(5, 8);
    @endphp
        @foreach($bonusYears  as $bonusYear)
        <tr class="bg-info text-center"><td colspan="8">{{$bonusYear == 5 ? '5 - 7' : '8'}}</td></tr>
        @foreach($employees as $employee)
        @if($employee->bonus_years == $bonusYear)
        <tr class="clickable-row employee-row {{$employee->disciplinary->count() > 0 ? 'table-danger' : ''}}" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td>{{$employee->first_name}} {{$employee->middle_initial}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            @if($employee->costCenter->count() > 0)
                @foreach($employee->costCenter as $costCenter)
                <td class="toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                @endforeach
            @else
                <td class="toggle-cost-center text-danger">Not Set</td>
            @endif
            @if($employee->shift->count() > 0)
                @foreach($employee->shift as $shift)
                <td class="toggle-shift">{{$shift->description}}</td>
                @endforeach
            @else
                <td class="toggle-shift text-danger">Not Set</td>
            @endif
            <td class="toggle-team-leader">{{$employee->team_leader}}</td>
            <td>
                @foreach($employee->disciplinary as $disciplinary)
                {{ucwords($disciplinary->type)}} {{ucwords($disciplinary->level)}} {{$disciplinary->date->format('m/d/Y')}}<br>
                @endforeach
            </td>
        </tr>
        @endif
        @endforeach
        @endforeach

    </tbody>
</table>