@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>{{ __('price_show_messages.products') }} {{ $product->product_nr }}_{{ $product->name }}_{{ $product->volume }}ml {{ __('price_show_messages.prices') }}</h2>
            </li>
            <a href="#buy" data-toggle="collapse" class="list-group-item list-group-item-primary list-group-item-action">
                <h3>{{ __('price_show_messages.buyPrices') }}</h3>
            </a>
            <div class="collapse show" id="buy">
                <li class="list-group-item list-group-item-info">
                    <div class="row">
                        <div class="col"><h4>{{ __('price_show_messages.priceActiveFrom') }}</h4></div>
                        <div class="col"><h4>{{ __('price_show_messages.pricePerUnit') }}</h4></div>
                        <div class="col"></div>
                    </div>
                </li>
                @if (count($all_buy_prices) == 0)
                    <li class="list-group-item">
                        <h5>{{ __('price_show_messages.noPricesInThisCategory') }}</h5>
                    </li>
                @endif
                @foreach ($all_buy_prices as $buy_price)
                    @if($buy_price_now && $buy_price->id == $buy_price_now->id)
                        <li class="list-group-item  list-group-item-success">
                    @else
                        <li class="list-group-item">
                    @endif
                        <div class="row">
                            <div class="col"><p>{{ $buy_price->active_from }}</p></div>
                            <div class="col"><p>{{ $buy_price->value }} eur</p></div>
                            <div class="col">
                                <a href="#edit_{{ $buy_price->id }}" data-toggle="collapse" class="btn btn-primary" type="button">{{ __('price_show_messages.edit') }}</a>
                                <a href="/price/delete/buy/{{ $buy_price->id }}" class="btn btn-primary" type="button">{{ __('price_show_messages.delete') }}</a>
                            </div>
                        </div>
                        <div class="collapse" id="edit_{{ $buy_price->id }}">
                            <div class="container">
                                <form action="/price/edit/buy" method="POST">
                                    @csrf
                                    <input type="hidden" name="buy_id" value="{{ $buy_price->id }}">
                                    <div class="row">
                                        <div class="col">
                                            <label for="date">{{ __('price_show_messages.newDate') }} : </label>
                                            <input type="date" name="date">
                                        </div>
                                        <div class="col">
                                            <label for="value">{{ __('price_show_messages.newPrice') }} : </label>
                                            <input type="number" step="0.01" min="0" name="value">
                                        </div>
                                        <div class="col">
                                            <input type="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li class="list-group-item">
                    <a href="#create_buy" data-toggle="collapse" class="btn btn-primary" type="button">{{ __('price_show_messages.addPrice') }}</a>
                </li>
                <div class="collapse" id="create_buy">
                    <li class="list-group-item">
                        <form action="/price/store/buy" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <label for="date"><p>{{ __('price_show_messages.priceActiveFrom') }} : </p></label>
                            <input type="date" name="date">
                            <label for="value"><p>{{ __('price_show_messages.price') }} : </p></label>
                            <input type="number" step="0.01" min="0" name="value"> eur
                            <input type="submit">
                        </form>
                        @if (!$errors->isEmpty())
                            <span style="color:red;font-weight:bold">{{ __('price_show_messages.invalidInput') }}</span>
                        @endif
                    </li>
                </div>
            </div>
            <a href="#sale" data-toggle="collapse" class="list-group-item list-group-item-primary list-group-item-action">
                <h3>{{ __('price_show_messages.sellPrices') }}</h3>
            </a>
            <div class="collapse show" id="sale">
                @foreach ($all_sale_prices as $price_type)
                    <a href="#type_{{ $price_type['type']->id }}" data-toggle="collapse" class="list-group-item list-group-item-action">
                        <h4>{{ $price_type['type']->name }}</h4>
                    </a>
                    <div class="collapse show container list-group-item" id="type_{{ $price_type['type']->id }}">
                        <li class="list-group-item list-group-item-info">
                            <div class="row">
                                <div class="col"><h4>{{ __('price_show_messages.priceActiveFrom') }}</h4></div>
                                <div class="col"><h4>{{ __('price_show_messages.pricePerUnit') }}</h4></div>
                                <div class="col"></div>
                            </div>
                        </li>
                        @if (count($price_type['all_sale_prices']) == 0)
                            <li class="list-group-item">
                                <h5>{{ __('price_show_messages.noPricesInThisCategory') }}</h5>
                            </li>
                        @endif
                        @foreach ($price_type['all_sale_prices'] as $sale_price)
                            @if($price_type['sale_price_now'] && $sale_price->id == $price_type['sale_price_now']->id)
                                <li class="list-group-item  list-group-item-success">
                            @else
                                <li class="list-group-item">
                            @endif
                                <div class="row">
                                    <div class="col"><p>{{ $sale_price->active_from }}</p></div>
                                    <div class="col"><p>{{ $sale_price->value }} eur</p></div>
                                    <div class="col">
                                        <a href="#edit_sale_{{ $sale_price->id }}" data-toggle="collapse" class="btn btn-primary" type="button">{{ __('price_show_messages.edit') }}</a>
                                        <a href="/price/delete/sale/{{ $sale_price->id }}" class="btn btn-primary" type="button">{{ __('price_show_messages.delete') }}</a>
                                    </div>
                                </div>
                                <div class="collapse" id="edit_sale_{{ $sale_price->id }}">
                                    <div class="container">
                                        <form action="/price/edit/sale" method="POST">
                                            @csrf
                                            <input type="hidden" name="sale_id" value="{{ $sale_price->id }}">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date">{{ __('price_show_messages.newDate') }} : </label>
                                                    <input type="date" name="date">
                                                </div>
                                                <div class="col">
                                                    <label for="value">{{ __('price_show_messages.newPrice') }} : </label>
                                                    <input type="number" step="0.01" min="0" name="value">
                                                </div>
                                                <div class="col">
                                                    <input type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            <a href="#create_sale_{{ $price_type['type']->id }}" data-toggle="collapse" class="btn btn-primary" type="button">{{ __('price_show_messages.addPrice') }}</a>
                        </li>
                        <div class="collapse" id="create_sale_{{ $price_type['type']->id }}">
                            <li class="list-group-item">
                                <form action="/price/store/sale" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="type_id" value="{{ $price_type['type']->id }}">
                                    <label for="date"><p>{{ __('price_show_messages.priceActiveFrom') }} : </p></label>
                                    <input type="date" name="date">
                                    <label for="value"><p>{{ __('price_show_messages.price') }} : </p></label>
                                    <input type="number" step="0.01" min="0" name="value"> eur
                                    <input type="submit">
                                </form>
                                @if (!$errors->isEmpty())
                                    <span style="color:red;font-weight:bold">{{ __('price_show_messages.invalidInput') }}</span>
                                @endif
                            </li>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection