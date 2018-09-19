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
            Edit Team: {{$team->description}}
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('teams.update', $team->id)}}" class="mt-2" id="edit-team-form" method="POST" autocomplete="off">
            @csrf
            @method('Patch')
            <a href="{{route('teams.show', ['id' => $team->id])}}" class="h3 text-primary my-4"><i class="fas fa-arrow-left"></i> Return To Show: {{$team->description}} {{$team->extension}}</a>

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                
                <div class="form-group col-md-6 col-lg-4">
                    <label for="edit-team-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="edit-team-description" name="description" value="{{old('description') ? old('description') : $team->description}}" required>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="edit-team-submit-button">Save Team</button>
        </form>
        @if(Auth::user()->hasAnyRole(['admin']))
        <form action="{{Route('teams.destroy', [$team->id])}}" class="mt-2" id="delete-team-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" id="delete-team-submit-button" name="team">Delete Team</button>
        </form>
        @endif

@endsection