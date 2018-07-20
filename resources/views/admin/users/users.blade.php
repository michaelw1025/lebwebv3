@extends('layouts.app')

@section('content')
    <section class="container-fluid h-100 border-top">
        <section class="row h-100">

                @include('admin.sidebar')

            <article class="col-10">
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
            </article>
        </section>
    </section>
@endsection