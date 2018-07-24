@extends('layouts.app')

@section('content')

    @include('admin.sidebar')

    <article class="col-10">

        <h2 class="mt-2 text-primary"><i class="fas fa-edit fa-lg"></i> Edit Role</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{route('roles.update', ['id' => $role->id])}}" class="mt-2" id="edit-role-form" method="POST">
            @csrf
            @method('Patch')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="role-description">Description</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="role-description" name="description" value="{{old('description') != null ? old('description') : $role->description}}" >
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('description') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="role-name">Name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="role-name" name="name" value="{{old('name') != null ? old('name') : $role->name}}" >
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary" form="edit-role-form">Save Role</button>
        </form>
        <form action="{{route('roles.destroy', ['id' => $role->id])}}" class="mt-2" id="delete-role-form" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-outline-danger btn-sm delete-item" form="delete-role-form" name="site role">Delete Role</button>
        </form>

    </article>

@endsection