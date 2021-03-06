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
            fa-user-tag
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show {{$termination->employee->first_name}} {{$termination->employee->last_name}} Termination
            @endslot

            @slot('displayExport')
            d-block
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-termination-form" method="GET" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $termination->employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$termination->employee->first_name}} {{$termination->employee->last_name}}</a>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-termination-type">Type</label>
                    <input type="text" class="form-control" id="show-termination-type" name="type" value="{{ucwords($termination->type)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-termination-date">Date</label>
                    <input type="text" class="form-control" id="show-termination-date" name="date" value="{{$termination->date->format('m/d/Y')}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-termination-last-day">Last Day</label>
                    <input type="text" class="form-control" id="show-termination-last-day" name="last_day" value="{{$termination->last_day->format('m/d/Y')}}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="show-termination-comments">Comments</label>
                    <textarea name="comments" id="show-termination-comments" rows="3" class="form-control" disabled>{{$termination->comments}}</textarea>
                </div>
            </div>


            

            <a href="{{route('terminations.edit', $termination->id)}}" class="btn btn-edit mt-4">Edit Termination</a>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection