@extends('layouts.app')

@section('content')
    <section class="container-fluid h-100 border-top">
        <section class="row h-100">

                @include('admin.sidebar')

            <article class="col-10">
                <form action="{{route('users.update', ['id' => $user->id])}}" class="mt-2" id="edit-user-form" method="POST">
                    @csrf
                    @method('Patch')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user-first-name">First Name</label>
                            <input type="text" class="form-control" id="user-first-name" name="first_name" value="{{old('first_name') != null ? old('first_name') : $user->first_name}}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="user-last-name">Last Name</label>
                            <input type="text" class="form-control" id="user-last-name" name="last_name" value="{{old('last_name') != null ? old('last_name') : $user->last_name}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user-email">Email</label>
                            <input type="text" class="form-control" id="user-email" name="email" value="{{old('email') != null ? old('email') : $user->email}}" required>
                        </div>

                        @foreach($user->role as $userRole)
                        <div class="form-group col-md-6">
                            <label for="user-role">Role</label>
                            <select name="user_role" id="user-role" class="form-control" name="role" required>
                                <option value="{{$userRole->id}}">{{$userRole->name}}</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary" form="edit-user-form">Edit User</button>
                </form>
                <form action="{{route('users.destroy', ['id' => $user->id])}}" class="mt-2" id="delete-user-form" method="POST">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="btn btn-outline-danger btn-sm delete-item" form="delete-user-form" name="site user">Delete User</button>
                </form>
                
                
            </article>
        </section>
    </section>
@endsection