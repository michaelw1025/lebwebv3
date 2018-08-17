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
            Show {{$disciplinary->employee->first_name}} {{$disciplinary->employee->last_name}} Disciplinary
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2" id="show-disciplinary-form" method="GET" autocomplete="off">
            @csrf
            <a href="{{route('employees.show', ['id' => $disciplinary->employee->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show {{$disciplinary->employee->first_name}} {{$disciplinary->employee->last_name}}</a>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-disciplinary-type">Type</label>
                    <input type="text" class="form-control" id="show-disciplinary-type" name="type" value="{{ucwords($disciplinary->type)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-disciplinary-level">Level</label>
                    <input type="text" class="form-control" id="show-disciplinary-level" name="level" value="{{ucwords($disciplinary->level)}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-disciplinary-date">Date</label>
                    <input type="text" class="form-control" id="show-disciplinary-date" name="date" value="{{$disciplinary->date->format('m/d/Y')}}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-disciplinary-cost-center">Cost Center</label>
                    <input type="text" class="form-control" id="show-disciplinary-cost-center" name="cost_center" value="{{$disciplinary->cost_center_number}} {{$disciplinary->cost_center_name}}" disabled>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="show-disciplinary-issued-by">Issued By</label>
                    <input type="text" class="form-control" id="show-disciplinary-issued-by" name="issued_by" value="{{$disciplinary->issuer_name}}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="show-disciplinary-comments">Comments</label>
                    <textarea name="comments" id="show-disciplinary-comments" rows="3" class="form-control" disabled>{{$disciplinary->comments}}</textarea>
                </div>
            </div>


            

            <a href="{{route('disciplinaries.edit', $disciplinary->id)}}" class="btn btn-edit mt-4">Edit Disciplinary</a>
        </form>

        <hr class="my-4"></hr>
        <hr class="my-4"></hr>

@endsection