@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-edit
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-edit
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Edit Position: {{$position->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('positions.update', $position->id)}}" class="mt-2" id="edit-position-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('positions.show', ['id' => $position->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$position->description}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-position-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="edit-position-description" name="description" value="{{old('description') ? old('description') : $position->description}}" required>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-position-job">Job @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('job') ? 'is-invalid' : ''}}" id="edit-position-job" name="job" required>
                    @if(!old('job') && $position->job->count() > 0)
                    @foreach($position->job as $positionJob)
                    <option selected value="{{$positionJob->pivot->job_id}}">{{$positionJob->description}}</option>
                    @endforeach
                    @endif
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
                    <label for="edit-position-wage-title">Wage Title @component('components.required-icon')@endComponent</label>
                    <select class="custom-select {{$errors->has('wage_title') ? 'is-invalid' : ''}}" id="edit-position-wage-title" name="wage_title" required>
                    @if(!old('wage_title') && $position->wageTitle->count() > 0)
                    @foreach($position->wageTitle as $positionWageTitle)
                    <option selected value="{{$positionWageTitle->pivot->wage_title_id}}">{{ucwords($positionWageTitle->description)}}</option>
                    @endforeach
                    @endif
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

            <button type="submit" class="btn btn-success" id="edit-position-submit-button">Save Position</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('positions.destroy', [$position->id])}}" class="mt-2" id="delete-position-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-position-submit-button" name="position">Delete Position</button>
        </form>
        @endif

@endsection