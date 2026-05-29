@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>User List App</h1>

    <div class="offset-md-2 col-md-8">

        <div class="card">

            @if(isset($user))

            <div class="card-header">
                Update User
            </div>

            <div class="card-body">

                <form action="/users/update" method="POST">

                    @csrf

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update User
                    </button>

                </form>

            </div>

            @else

            <div class="card-header">
                New User
            </div>

            <div class="card-body">

                <form action="/users/create" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>

                        <input type="email"
                               name="email"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">
                        Add User
                    </button>

                </form>

            </div>

            @endif

        </div>

        <!-- Users Table -->

        <div class="card mt-4">

            <div class="card-header">
                Current Users
            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($users as $user)

                        <tr>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>

                                <form action="/users/delete/{{ $user->id }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-danger">
                                        Delete
                                    </button>

                                </form>

                                <form action="/users/edit/{{ $user->id }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-info">
                                        Edit
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
