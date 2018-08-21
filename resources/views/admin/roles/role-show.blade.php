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
            fa-user-shield
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show Role
            @endslot

            @slot('displayExport')
            d-none
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2">
            @csrf
            @method('Patch')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{$role->description}}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$role->name}}" readonly>
                </div>
            </div>
        </form>
        
        <a href="{{route('roles.edit', ['id' => $role->id])}}" class="btn btn-edit">Edit Role</a>

@endsection