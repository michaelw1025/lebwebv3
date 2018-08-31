<table class="table table-sm table-hover">
    <thead class="bg-header text-light">
        <tr>
            <th scope="col" class="d-none d-lg-table-cell">ID</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col" class="toggle-hire-date">Hire Date</th>
            <th scope="col" class="toggle-reduction-date">Reduction Date</th>
            <th scope="col" class="toggle-home-cost-center">Home CC</th>
            <th scope="col" class="toggle-bump-to-cost-center">Bump To CC</th>
            <th scope="col" class="toggle-home-shift">Home Shift</th>
            <th scope="col" class="toggle-bump-to-shift">Bump To Shift</th>
            <th scope="col" class="toggle-return-date">Return Date</th>
            <th scope="col" class="toggle-fiscal-week">Fiscal Wk</th>
            <th scope="col" class="toggle-fiscal-year">Fiscal Yr</th>
        </tr>
    </thead>
    <tbody>
    @php
    $reductionTypes = array('voluntary', 'involuntary');
    $reductionDisplacements = array('layoff', 'bump');
    @endphp
        @foreach($reductionTypes as $reductionType)
        @foreach($reductionDisplacements as $reductionDisplacement)
        <tr class="bg-info text-center"><td colspan="12">{{ucwords($reductionType)}} {{ucwords($reductionDisplacement)}}</td></tr>
        @foreach($employees as $employee)
        @foreach($employee->reduction as $employeeReduction)
        @if($employeeReduction->type == $reductionType && $employeeReduction->displacement == $reductionDisplacement)
        <tr class="clickable-row employee-row" data-href="{{route('employees.show', ['id' => $employee->id])}}">
            <td class="d-none d-lg-table-cell">{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td class="toggle-hire-date">{{$employee->hire_date->format('m/d/Y')}}</td>
            <td class="toggle-reduction-date">{{$employeeReduction->date->format('m/d/Y')}}</td>
            <td class="toggle-home-cost-center">{{$employeeReduction->home_cost_center_number}}</td>
            <td class="toggle-bump-to-cost-center">{{$employeeReduction->bump_to_cost_center_number}}</td>
            <td class="toggle-home-shift">{{$employeeReduction->home_shift_name}}</td>
            <td class="toggle-bump-to-shift">{{$employeeReduction->bump_to_shift_name}}</td>
            <td class="toggle-return-date">{{$employeeReduction->return_date->format('m/d/Y')}}</td>
            <td class="toggle-fiscal-week">{{$employeeReduction->fiscal_week}}</td>
            <td class="toggle-fiscal-year">{{$employeeReduction->fiscal_year}}</td>
        </tr>
        @endif
        @endforeach
        @endforeach
        @endforeach
        @endforeach
    </tbody>
</table>