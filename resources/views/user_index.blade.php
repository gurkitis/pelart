@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>Users</h2>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col"><h4>Name</h4></div>
                    <div class="col"><h4>Email</h4></div>
                    <div class="col"><h4>Role</h4></div>
                    <div class="col"></div>
                </div>
            </li>
            @foreach ($users as $user)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col"><p>{{ $user->name }}</p></div>
                        <div class="col"><p>{{ $user->email }}</p></div>
                        <div class="col"><p>{{ $user->role }}</p></div>
                        <div class="col">
                            @if ($user->role != 'admin')
                                <a class="btn btn-primary" type="button" href="/user/delete/{{ $user->id }}">Delete</a>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
@endsection