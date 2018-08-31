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

        <tr class="bg-info"><th scope="row" colspan="5">{{$searchedCostCenter->number}} {{$searchedCostCenter->extension}} {{$searchedCostCenter->description}}</th></tr>
        <tr class="table-info">
                <td><strong>Staff:</strong> {{$searchedCostCenter->staff_manager}}</td>
                <td><strong>Day TM:</strong> {{$searchedCostCenter->day_manager}}</td>
                <td><strong>Day TL:</strong> {{$searchedCostCenter->day_leader}}</td>
                <td><strong>Night TM:</strong> {{$searchedCostCenter->night_manager}}</td>
                <td><strong>Night TL:</strong> {{$searchedCostCenter->night_leader}}</td>
        </tr>
        @foreach($searchedCostCenter->employee as $employee)

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

        @endforeach

    </tbody>
</table>