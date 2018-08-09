@extends('layouts.app')

@section('content')

    @include('admin.sidebar')

    <article class="col-10  main-content-article">
        <h2 class="mt-2 text-primary"><i class="fas fa-shield-alt fa-lg"></i> Roles</h2>
        <hr></hr>

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

    </article>

@endsection