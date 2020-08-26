@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>Storage</h2>
            </li>
            @if ($products == NULL)
                <li class="list-group-item">
                    <h4>No items in storage</h4>
                </li>
            @else
                <li class="list-group-item list-group-item-info">
                <div class="row">
                    <div class="col">
                        <h4>Product nr</h4>
                    </div>
                    <div class="col">
                        <h4>Name</h4>
                    </div>
                    <div class="col">
                        <h4>Volume</h4>
                    </div>
                    <div class="col">
                        <h4>Quantity</h4>
                    </div>
                    <div class="col">

                    </div>
                </div>
                </li>
                @foreach ($products as $product)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">{{ $product->product_nr }}</div>
                            <div class="col">{{ $product->name }}</div>
                            <div class="col">{{ $product->volume }} ml</div>
                            <div class="col">{{ $product->quantity }}</div>
                            <div class="col">
                                <a class="btn btn-primary" href="/product/{{ $product->nr }}" role="button">Show</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </div>
    </div>
@endsection