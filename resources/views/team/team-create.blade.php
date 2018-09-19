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
            Create: Team
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{Route('teams.store')}}" class="mt-2" id="create-team-form" method="POST" autocomplete="off">
            @csrf

            <p class="text-danger mt-4">@component('components.required-icon')@endComponent indicates a required field</p>

            <div class="form-row mt-4">
                
                <div class="form-group col-md-6 col-lg-4">
                    <label for="create-team-description">Description @component('components.required-icon')@endComponent</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="create-team-description" name="description" value="{{old('description')}}" required>
                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-success" id="create-team-submit-button">Create Team</button>
        </form>


@endsection