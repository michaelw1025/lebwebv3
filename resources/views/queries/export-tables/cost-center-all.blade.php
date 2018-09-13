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
        @foreach($costCenter->employee as $costCenterEmployee)


        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $costCenterEmployee->pivot->employee_id])}}">
            <td>{{$costCenterEmployee->pivot->employee_id}}</td>
            <td>{{$costCenterEmployee->first_name}}</td>
            <td>{{$costCenterEmployee->last_name}}</td>
            @if($costCenterEmployee->job->count() > 0)
                @foreach($costCenterEmployee->job as $job)
                <td class="">{{$job->description}}</td>
                @endforeach
            @else
                <td class=" text-danger">Not Set</td>
            @endif
            @if($costCenterEmployee->position->count() > 0)
                @foreach($costCenterEmployee->position as $position)
                <td class="">{{$position->description}}</td>
                @endforeach
            @else
                <td class=" text-danger">Not Set</td>
            @endif
        </tr>


        @endforeach
    @endforeach
    </tbody>
</table>