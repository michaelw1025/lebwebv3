@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-primary
            @endslot

            @slot('fontStyle')
            fas
            @endslot

            @slot('fontIcon')
            fa-info-circle
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show Position: {{$position->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-position-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-position-description">Description</label>
                    <input type="text" class="form-control" id="show-position-description" name="description" value="{{$position->description}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-position-job">Job</label>
                    <input type="text" class="form-control" id="show-position-job" name="job" value="@foreach($position->job as $positionJob) {{$positionJob->description}}  @endforeach" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-position-wage-title">Wage Title</label>
                    <input type="text" class="form-control" id="show-position-wage-title" name="wage_title" value="@foreach($position->wageTitle as $positionWageTitle) {{ucwords($positionWageTitle->description)}} @endforeach" disabled>
                </div>
            </div>

            <a href="{{route('positions.edit', $position->id)}}" class="btn btn-edit mt-4">Edit Position</a>
        </form>

@endsection