@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>{{ $date }} {{ __('sale_show_messages.sales') }}</h2>
            </li>
            <li class="list-group-item list-group-item-info">
                <div class="row">
                    <div class="col"><h4>{{ __('sale_show_messages.productNr') }}</h4></div>
                    <div class="col-3"><h4>{{ __('sale_show_messages.productName') }}</h4></div>
                    <div class="col"><h4>{{ __('sale_show_messages.quantity') }}</h4></div>
                    <div class="col"><h4>{{ __('sale_show_messages.priceType') }}</h4></div>
                    <div class="col"><h4>{{ __('sale_show_messages.pricePerUnit') }}</h4></div>
                    <div class="col"><h4>{{ __('sale_show_messages.total') }}</h4></div>
                    <div class="col"></div>
                </div>
            </li>
            @foreach ($data as $sale)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col"><p>{{ $sale['product_nr'] }}</p></div>
                        <div class="col-3"><p>{{ $sale['name'] }}</p></div>
                        <div class="col"><p>{{ $sale['quantity'] }}</p></div>
                        <div class="col"><p>{{ $sale['type_name'] }}</p></div>
                        <div class="col"><p>{{ $sale['price'] }} eur</p></div>
                        <div class="col"><p>{{ $sale['total'] }} eur</p></div>
                        <div class="col">
                            <a href="/sale/delete/{{ $sale['sale_id'] }}" class="btn btn-primary" type="button">{{ __('sale_show_messages.delete') }}</a>
                        </div>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <div class="float-right"><h5>{{ __('sale_show_messages.grandTotal') }} : {{ $total }} eur</h5></div>
            </li>
        </div>
    </div>
@endsection