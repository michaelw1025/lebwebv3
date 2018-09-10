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
            Edit Wage Title: {{ucwords($wageTitle->description)}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('wageTitles.update', $wageTitle->id)}}" class="mt-2" id="edit-wage-title-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('wageTitles.show', ['id' => $wageTitle->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{ucwords($wageTitle->description)}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-wage-title-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="edit-wage-title-description" name="description" value="{{old('description') ? old('description') : ucwords($wageTitle->description)}}">
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row mt-4">
                @if($errors->has('wage_progression.*.amount'))
                    <p class="text-danger">
                        {{$errors->first('wage_progression.*.amount')}}
                    </p>
                @endif
                @if($errors->has('wage_progression.*.numeric'))
                    <p class="text-danger">
                        {{$errors->first('wage_progression.*.numeric')}}
                    </p>
                @endif

                @foreach($wageProgressions as $wageProgression)
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$wageProgression->month}}</span>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control d-none" id="edit-wage-title-wage-progression-{{$wageProgression->id}}-id" name="wage_progression[{{$loop->index}}][id]" value="{{$wageProgression->id}}" readonly>
                    @if(old('wage_progression'))
                    <input type="text" class="form-control {{$errors->has('wage_progression.'.$loop->index.'.amount') ? 'is-invalid' : ''}} {{$errors->has('wage_progression.'.$loop->index.'.numeric') ? 'is-invalid' : ''}}" name="wage_progression[{{$loop->index}}][amount]" value="{{old('wage_progression.'.$loop->index.'.amount')}}">
                    @else
                    @foreach($wageTitle->wageProgression as $wageTitleWageProgression)
                    @if($wageTitleWageProgression->pivot->wage_progression_id == $wageProgression->id)
                    <input type="text" class="form-control {{$errors->has('wage_progression.'.$loop->parent->index.'.amount') ? 'is-invalid' : ''}} {{$errors->has('wage_progression.'.$loop->parent->index.'.numeric') ? 'is-invalid' : ''}}" name="wage_progression[{{$loop->parent->index}}][amount]" value="{{$wageTitleWageProgression->pivot->amount}}">
                    @endif
                    @endforeach
                    @endif
                                   
                </div>
                @endforeach

            </div>

            <button type="submit" class="btn btn-success" id="edit-wage-title-submit-button">Save Wage Title</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('wageTitles.destroy', [$wageTitle->id])}}" class="mt-2" id="delete-wage-title-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-wage-title-submit-button" name="wage title">Delete Wage Title</button>
        </form>
        @endif

@endsection