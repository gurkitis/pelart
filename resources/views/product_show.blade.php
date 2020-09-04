@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('product_show_messages.product') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nr : {{ $product->product_nr}}</li>
                            <li class="list-group-item">{{ __('product_show_messages.name') }} : {{ $product->name}}</li>
                            <li class="list-group-item">{{ __('product_show_messages.volume') }} : {{ $product->volume}}ml</li>
                            <li class="list-group-item">{{ __('product_show_messages.inStorage') }} : {{ $product->quantity}}</li>
                        </ul>
                        <br>
                        <a href="#edit" data-toggle="collapse" class="btn btn-primary" type="button">{{ __('product_show_messages.edit') }}</a>
                        @if (!$errors->isEmpty())
                            <span style="color:red;font-weight:bold">{{ __('delivery_create_messages.invalidInput')}}</span>
                        @endif
                    </div>
                    <div class="collapse" id="edit">
                        <div class="container">
                            <form action="/product/edit" method="POST">
                                @csrf
                                <label for="product_nr">{{ __('storage_create_messages.productNr') }} : </label>
                                <input type="text" name="product_nr">
                                <br>
                                <label for="product_name">{{ __('storage_create_messages.productName') }} : </label>
                                <input type="text" name="product_name">
                                <br>
                                <label for="volume">{{ __('storage_create_messages.volume') }} : </label>
                                <input type="number" min="1" name="volume"> ml
                                <br>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input class="btn btn-primary" type="submit" value="{{ __('product_show_messages.submit') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Prices</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-subtitle">{{ __('product_show_messages.buyPrice') }}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $buyPrice }}eur</li>
                        </ul>
                        <br>
                        <h5 class="card-subtitle">{{ __('product_show_messages.salePrice') }}</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($sellPrices as $key => $salePrice)
                                <li class="list-group-item">{{ $key }} : {{ $salePrice }}eur</li>
                            @endforeach
                        </ul>
                        <a href="/price/show/{{ $product->id }}" class="btn btn-primary">{{ __('product_show_messages.edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection