@extends('layouts.app')

@section('content')

    @include('admin.sidebar')

    <article class="col-10  main-content-article">
    
        <h2 class="mt-2 text-create"><i class="fas fa-pen fa-lg"></i> Create Role</h2>
        <hr></hr>

        @include('alerts.validation-alert')
        @include('alerts.session-alert')

        <form action="{{route('roles.store')}}" class="mt-2" id="create-role-form" method="POST">
            @csrf
            @method('Post')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="role-create-description">Description</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="role-create-description" name="description" value="{{old('description')}}">
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('description') }}
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="role-create-name">Name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="role-create-name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success" form="create-role-form">Save Role</button>
        
        </form>
    
    </article>


@endsection