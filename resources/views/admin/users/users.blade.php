@extends('layouts.app')

@section('content')

        <!-- Title for content -->
        @component('components.content-title')
            @slot('textClass')
            text-primary
            @endslot

            @slot('fontStyle')
            far
            @endslot

            @slot('fontIcon')
            fa-address-book
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Users
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <table class="table table-sm table-hover table-striped table-borderless">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col" class="d-none d-md-table-cell">Email</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="clickable-row" data-href="{{route('users.show', ['id' => $user->id])}}">
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td class="d-none d-md-table-cell">{{$user->email}}</td>
                    @foreach($user->role as $role)
                    <td>{{$role->name}}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection