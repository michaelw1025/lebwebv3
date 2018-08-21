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
            fa-id-card
            @endslot

            @slot('fontSize')
            fa-lg
            @endslot

            @slot('title')
            Show User
            @endslot

            @slot('displayExport')
            d-none
            @endslot
        @endcomponent

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="" class="mt-2">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly>
                </div>


                <div class="form-group col-md-6">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" name="role" value="@foreach($user->role as $userRole) {{$userRole->name}} @endforeach" readonly>
                </div>

            </div>
        </form>    

        <a href="{{route('users.edit', ['id' => $user->id])}}" class="btn btn-edit">Edit User</a>

@endsection