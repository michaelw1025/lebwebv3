@extends('layouts.app')

@section('content')

    @include('admin.sidebar')

    <article class="col-10 main-content-article">

        <h2 class="mt-2 text-edit"><i class="fas fa-edit fa-lg"></i> Edit User</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{route('users.update', ['id' => $user->id])}}" class="mt-2" id="edit-user-form" method="POST">
            @csrf
            @method('Patch')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-first-name">First Name</label>
                    <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="user-first-name" name="first_name" value="{{old('first_name') != null ? old('first_name') : $user->first_name}}" required>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('first_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="user-last-name">Last Name</label>
                    <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="user-last-name" name="last_name" value="{{old('last_name') != null ? old('last_name') : $user->last_name}}" required>
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('last_name') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-email">Email</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="user-email" name="email" value="{{old('email') != null ? old('email') : $user->email}}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="user-role">Role</label>
                    <select name="role" id="user-role" class="custom-select {{$errors->has('role') ? 'is-invalid' : ''}}" required>
                        @foreach($user->role as $userRole)
                        <option value="{{$userRole->id}}">{{$userRole->name}}</option>
                        @endforeach
                        <option></option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('role') }}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success" form="edit-user-form">Save User</button>
        </form>
        <form action="{{route('users.destroy', ['id' => $user->id])}}" class="mt-2" id="delete-user-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger delete-item" form="delete-user-form" name="site user">Delete User</button>
        </form>
            
    </article>

@endsection