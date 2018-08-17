@extends('layouts.app')

@section('content')

    <article class="col-8 col-xs-9 col-sm-10 main-content-article">
        <h2 class="mt-2 text-primary"><i class="far fa-address-book fa-lg"></i> Cost Centers</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="d-none d-md-table-cell">Staff Manager</th>
                </tr>
            </thead>
            <tbody>
                @foreach($costCenters as $costCenter)
                <tr class="clickable-row" data-href="{{route('costCenters.show', ['id' => $costCenter->id])}}">
                    <td>{{$costCenter->number}}</td>
                    <td>{{$costCenter->extension}}</td>
                    <td>{{$costCenter->description}}</td>
                    @foreach($costCenter->employeeStaffManager as $staffManager)
                    <td class="d-none d-md-table-cell"></td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

    </article>

@endsection