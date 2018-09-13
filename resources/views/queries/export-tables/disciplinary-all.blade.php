<table class="table table-sm table-hover table-striped table-borderless">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="">Hire Date</th>
            <th scope="col">Level</th>
            <th scope="col">Disc Date</th>
            <th scope="col">Issued By</th>
            <th scope="col" class="d-none toggle-service-date">Service Date</th>
            <th scope="col" class="d-none toggle-bid-eligible">Bid Eligible</th>
            <th scope="col" class="d-none toggle-shift">Shift</th>
            <th scope="col" class="d-none toggle-position">Position</th>
            <th scope="col" class="d-none toggle-cost-center">Cost Center</th>
            <th scope="col" class="d-none toggle-team-manager">Team Manager</th>
            <th scope="col" class="d-none toggle-team-leader">Team Leader</th>
        </tr>
    </thead>
    <tbody>
    @php
    $disciplinaryTypeArray = array('attendance', 'performance');
    @endphp
    @foreach($disciplinaryTypeArray as $type)
    <tr class="{{$type == 'attendance' ? 'table-warning' : 'table-danger'}} text-center"><td colspan="14">{{strtoupper($type)}}</td></tr>
        @foreach($employees as $employee)
        @foreach($employee->disciplinary as $employeeDisciplinary)
        @if($employeeDisciplinary->type == $type)
        <tr class="clickable-row employee-row" data-href="{{route('disciplinaries.show', ['id' => $employeeDisciplinary->id])}}">
            <td>{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="">{{$employee->hire_date->format('m/d/Y')}}</td>
            <td>{{ucwords($employeeDisciplinary->level)}}</td>
            <td class="">{{$employeeDisciplinary->date->format('m/d/Y')}}</td>
            <td>{{$employeeDisciplinary->issued_by_name}}</td>
            <td class="d-none toggle-service-date">{{$employee->service_date->format('m/d/Y')}}</td>
            <td class="d-none toggle-bid-eligible"><i class="{{$employee->bid_eligible == 1 ? 'far fa-thumbs-up text-success' : 'far fa-thumbs-down text-danger'}}"></i></td>
            @if($employee->shift->count() > 0)
                @foreach($employee->shift as $shift)
                <td class="d-none toggle-shift">{{$shift->description}}</td>
                @endforeach
            @else
                <td class="d-none toggle-shift text-danger">Not Set</td>
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
        @endif
        @endforeach
        @endforeach
    @endforeach
    </tbody>
</table>