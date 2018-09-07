@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-create
            @endslot

            @slot('fontStyle')
            fas
            @endslot

            @slot('fontIcon')
            fa-drafting-compass
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Create: Position
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('positions.store')}}" class="mt-2" id="create-position-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-position-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="create-position-description" name="description" value="{{old('description')}}">
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-position-job">Job @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('job') ? 'is-invalid' : ''}}" id="create-position-job" name="job">
                    <option value=""></option>
                    @foreach($jobs as $job)
                    <option {{old('job') ? (old('job') == $job->id ? 'selected' : '') : ''}} value="{{$job->id}}">{{$job->description}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('job'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('job')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-position-wage-title">Wage Title @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('wage_title') ? 'is-invalid' : ''}}" id="create-position-wage-title" name="wage_title">
                    <option value=""></option>
                    @foreach($wageTitles as $wageTitle)
                    <option {{old('wage_title') ? (old('wage_title') == $wageTitle->id ? 'selected' : '') : ''}} value="{{$wageTitle->id}}">{{ucwords($wageTitle->description)}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('wage_title'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('wage_title')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-position-submit-button">Create Position</button>
        </form>


@endsection