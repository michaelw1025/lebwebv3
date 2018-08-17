@extends('layouts.app')

@section('content')

    <article class="col-10  main-content-article">

        <h2 class="mt-2 text-primary"><i class="fas fa-user-shield fa-lg"></i> Show Role</h2>
        <hr></hr>

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

    </article>

@endsection