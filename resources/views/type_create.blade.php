@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>Create new price type</h2>
            </li>
            <li class="list-group-item">
                <form action="/type/store" method="POST">
                    @csrf
                    <div class="row">
                        <label for="type_name">Type name : </label>
                        <input type="text" name="type_name">
                    </div>
                    <div class="row">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    @if (!$errors->isEmpty())
                        <span style="color:red;font-weight:bold">Invalid input</span>
                    @endif
                </form>
            </li>
        </div>
    </div>
@endsection