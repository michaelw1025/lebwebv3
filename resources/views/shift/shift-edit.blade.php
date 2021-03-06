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
            Edit Shift: {{$shift->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('shifts.update', $shift->id)}}" class="mt-2" id="edit-shift-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('shifts.show', ['id' => $shift->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$shift->description}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">

                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-shift-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="edit-shift-description" name="description" value="{{old('description') ? old('description') : $shift->description}}" required>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>
                
            </div>

            <button type="submit" class="btn btn-success" id="edit-shift-submit-button">Save Shift</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('shifts.destroy', [$shift->id])}}" class="mt-2" id="delete-shift-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-shift-submit-button" name="shift">Delete Shift</button>
        </form>
        @endif

@endsection