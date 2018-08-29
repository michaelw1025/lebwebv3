<table class="table table-sm table-hover table-striped table-borderless">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Job</th>
            <th scope="col">Position</th>
        </tr>
    </thead>
    <tbody>
    @foreach($costCenters as $costCenter)
        <tr class="bg-info"><th scope="row" colspan="5">{{$costCenter->number}} {{$costCenter->extension}} {{$costCenter->description}}</th></tr>
        <tr class="table-info">
                <td><strong>Staff:</strong> {{$costCenter->staff_manager}}</td>
                <td><strong>Day TM:</strong> {{$costCenter->day_manager}}</td>
                <td><strong>Day TL:</strong> {{$costCenter->day_leader}}</td>
                <td><strong>Night TM:</strong> {{$costCenter->night_manager}}</td>
                <td><strong>Night TL:</strong> {{$costCenter->night_leader}}</td>
        </tr>
        @foreach($employees as $employee)
        @foreach($employee->costCenter as $employeeCostCenter)
        @if($employeeCostCenter->id === $costCenter->id)
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td>{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            @if($employee->job->count() > 0)
                @foreach($employee->job as $job)
                <td class="">{{$job->description}}</td>
                @endforeach
            @else
                <td class=" text-danger">Not Set</td>
            @endif
            @if($employee->position->count() > 0)
                @foreach($employee->position as $position)
                <td class="">{{$position->description}}</td>
                @endforeach
            @else
                <td class=" text-danger">Not Set</td>
            @endif
        </tr>
        @endif
        @endforeach
        @endforeach
    @endforeach
    </tbody>
</table>