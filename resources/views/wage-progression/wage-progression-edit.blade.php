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
            Edit Wage Progression: {{$wageProgression->month}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('wageProgressions.update', $wageProgression->id)}}" class="mt-2" id="edit-wage-progression-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('wageProgressions.show', ['id' => $wageProgression->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$wageProgression->month}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-wage-progression-month">Month @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('month') ? 'is-invalid' : ''}}" id="edit-wage-progression-month" name="month" value="{{old('month') ? old('month') : $wageProgression->month}}">
                    @if($errors->has('month'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('month')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <button type="submit" class="btn btn-success" id="edit-wage-progression-submit-button">Save Wage Progression</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('wageProgressions.destroy', [$wageProgression->id])}}" class="mt-2" id="delete-wage-progression-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-wage-progression-submit-button" name="wage progression">Delete Wage Progression</button>
        </form>
        @endif

@endsection