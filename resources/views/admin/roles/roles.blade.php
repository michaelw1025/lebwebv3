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
            fa-shield-alt
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Roles
            @endslot

            @slot('displayExport')
            d-none
            @endslot

            @slot('exportRoute')
            
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr class="clickable-row" data-href="{{route('roles.show', ['id' => $role->id])}}">
                    <td>{{$role->description}}</td>
                    <td>{{$role->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('roles.create')}}" class="btn btn-create">Create New Role</a>

@endsection