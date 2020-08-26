@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>Menu</h2>
            </li>
            <a href="#storage" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>Storage</h4></a>
            <div class="collapse" id="storage">
                <a href="/storage/create" class="list-group-item list-group-item-action bg-info text-white">Add new product</a>
                <a href="/storage/index" class="list-group-item list-group-item-action bg-info text-white">Storage</a>
            </div>

            <a href="#delivery" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>Delivery</h4></a>
            <div class="collapse" id="delivery">
                <a href="/delivery/create" class="list-group-item list-group-item-action bg-info text-white">New delivery</a>
                <a href="/delivery/index" class="list-group-item list-group-item-action bg-info text-white">Delivery history</a>
            </div>

            <a href="#prices" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>Prices</h4></a>
            <div class="collapse" id="prices">
                <a href="/price/index" class="list-group-item list-group-item-action bg-info text-white">All prices</a>
                <a href="/type/create" class="list-group-item list-group-item-action bg-info text-white">New price type</a>
            </div>

            <a href="#sale" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>Sales</h4></a>
            <div class="collapse" id="sale">
                <a href="/sale/create" class="list-group-item list-group-item-action bg-info text-white">New sale</a>
                <a href="/sale/index" class="list-group-item list-group-item-action bg-info text-white">Sales history</a>
            </div>

            @if ($role == 'admin')
                <a href="#users" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>Users</h4></a>
                <div class="collapse" id="users">
                    <a href="/register" class="list-group-item list-group-item-action bg-info text-white">Register new user</a>
                    <a href="/user/index" class="list-group-item list-group-item-action bg-info text-white">View users</a>
                </div>           
            @endif
        </div>
    </div>
@endsection
