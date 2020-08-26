@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>{{ $date }} Delivery</h2>
            </li>
            <li class="list-group-item list-group-item-info">
                <div class="row">
                    <div class="col"><h4>Product nr</h4></div>
                    <div class="col-3"><h4>Product name</h4></div>
                    <div class="col"><h4>Quantity</h4></div>
                    <div class="col"><h4>Price per unit</h4></div>
                    <div class="col"><h4>Total</h4></div>
                    <div class="col"></div>
                </div>
            </li>
            @foreach ($deliveries as $delivery)
                @if ($delivery['dameged'] == 1)
                    <li class="list-group-item list-group-item-danger">
                @else
                    <li class="list-group-item">
                @endif
                    <div class="row">
                        <div class="col"><p>{{ $delivery['product_nr'] }}</p></div>
                        <div class="col-3"><p>{{ $delivery['name'] }}</p></div>
                        <div class="col"><p>{{ $delivery['quantity'] }}</p></div>
                        <div class="col"><p>{{ $delivery['price'] }} eur</p></div>
                        <div class="col"><p>{{ $delivery['sum'] }} eur</p></div>
                        <div class="col">
                            <a href="/delivery/delete/{{ $delivery['id'] }}" class="btn btn-primary" type="button">Delete</a>
                        </div>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <div class="float-right">
                    <h5 class="bg-success">Grand total: {{ $total }} eur</h5>
                    <h5 class="bg-danger">Dameged total: {{ $dameges }} eur</h5>
                    <h5>Grand - Dameged = {{ $real_total }} eur</h5>
                </div>
            </li>
        </div>
    </div>
@endsection