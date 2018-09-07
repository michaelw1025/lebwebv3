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
            Show Job: {{$job->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-job-form" method="GET" autocomplete="off">
            @csrf

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-job-description">Description</label>
                    <input type="text" class="form-control" id="show-job-description" name="description" value="{{$job->description}}" disabled>
                </div>
            </div>

            <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-edit mt-4">Edit Job</a>
        </form>

@endsection