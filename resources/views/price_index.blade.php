@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>{{ __('price_index_messages.selectProduct') }}</h2>
            </li>
            <li class="list-group-item list-group-item-info">
                <div class="row">
                    <div class="col"><h4>{{ __('price_index_messages.productNr') }}</h4></div>
                    <div class="col-10"><h4>{{ __('price_index_messages.productName') }}</h4></div>
                </div>
            </li>
            @foreach ($products as $product)
                <a class="list-group-item list-group-item-action" href="/price/show/{{ $product->id }}">
                    <div class="row">
                        <div class="col"><p>{{ $product->product_nr }}</p></div>
                        <div class="col-10"><p>{{ $product->name }}_{{ $product->volume }}ml</p></div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection