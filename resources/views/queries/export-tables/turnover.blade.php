<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col" class="d-none d-lg-table-cell">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="toggle-hire-date">Hire Date</th>
            <th scope="col" class="toggle-termination-date">Term Date</th>
            <th scope="col" class="toggle-termination-last-date">Last Day</th>
            <th scope="col" class="toggle-cost-center">Cost Center</th>

        </tr>
    </thead>
    <tbody>
    @php
    $terminationTypes = array('voluntary', 'involuntary');
    @endphp
        @foreach($terminationTypes as $terminationType)
        <tr class="bg-info text-center"><td colspan="12">{{ucwords($terminationType)}}</td></tr>
        @foreach($employees as $employee)
        @foreach($employee->termination as $employeeTermination)
        @if($employeeTermination->type == $terminationType)
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            <td class="toggle-termination-date">{{$employeeTermination->date->format('m/d/Y')}}</td>
            <td class="toggle-termination-last-date">{{$employeeTermination->last_day->format('m/d/Y')}}</td>
            @if($employee->costCenter->count() > 0)
                @foreach($employee->costCenter as $costCenter)
                <td class="toggle-cost-center">{{$costCenter->number}} {{$costCenter->extension != null ? ' - '.$costCenter->extension : ''}}</td>
                @endforeach
            @else
                <td class="d-none toggle-cost-center text-danger">Not Set</td>
            @endif
        </tr>
        @endif
        @endforeach
        @endforeach
        @endforeach

    </tbody>
</table>