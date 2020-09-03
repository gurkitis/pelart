@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>{{ $date }} {{ __('delivery_show_messages.delivery')}}</h2>
            </li>
            <li class="list-group-item list-group-item-info">
                <div class="row">
                    <div class="col"><h4>{{ __('delivery_show_messages.productNr')}}</h4></div>
                    <div class="col-3"><h4>{{ __('delivery_show_messages.productName')}}</h4></div>
                    <div class="col"><h4>{{ __('delivery_show_messages.quantity')}}</h4></div>
                    <div class="col"><h4>{{ __('delivery_show_messages.pricePerUnit')}}</h4></div>
                    <div class="col"><h4>{{ __('delivery_show_messages.total')}}</h4></div>
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
                            <a href="/delivery/delete/{{ $delivery['id'] }}" class="btn btn-primary" type="button">{{ __('delivery_show_messages.delete')}}</a>
                        </div>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <div class="float-right">
                    <h5 class="bg-success">{{ __('delivery_show_messages.grandTotal')}}: {{ $total }} eur</h5>
                    <h5 class="bg-danger">{{ __('delivery_show_messages.damagedTotal')}}: {{ $dameges }} eur</h5>
                    <h5>{{ __('delivery_show_messages.grand-damaged')}} = {{ $real_total }} eur</h5>
                </div>
            </li>
        </div>
    </div>
@endsection