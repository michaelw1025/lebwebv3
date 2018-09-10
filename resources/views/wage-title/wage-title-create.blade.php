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
            Create: Wage Title
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('wageTitles.store')}}" class="mt-2" id="create-wage-title-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-wage-title-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="create-wage-title-description" name="description" value="{{old('description')}}">
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
                    <input type="text" class="form-control d-none" id="create-wage-title-wage-progression-{{$wageProgression->id}}-id" name="wage_progression[{{$loop->index}}][id]" value="{{$wageProgression->id}}" readonly>
                    <input type="text" class="form-control {{$errors->has('wage_progression.'.$loop->index.'.amount') ? 'is-invalid' : ''}} {{$errors->has('wage_progression.'.$loop->index.'.numeric') ? 'is-invalid' : ''}}" name="wage_progression[{{$loop->index}}][amount]" value="{{old('wage_progression.'.$loop->index.'.amount')}}">
                </div>
                @endforeach

            </div>

            <button type="submit" class="btn btn-success" id="create-cost-center-submit-button">Create Wage Title</button>
        </form>


@endsection