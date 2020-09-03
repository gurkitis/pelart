@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>{{ __('home_messages.menu')}}</h2>
            </li>
            <a href="#storage" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>{{ __('home_messages.storage')}}</h4></a>
            <div class="collapse" id="storage">
                <a href="/storage/create" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.addNewProduct')}}</a>
                <a href="/storage/index" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.storage')}}</a>
            </div>

            <a href="#delivery" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>{{ __('home_messages.delivery')}}</h4></a>
            <div class="collapse" id="delivery">
                <a href="/delivery/create" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.newDelivery')}}</a>
                <a href="/delivery/index" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.deliveryHistory')}}</a>
            </div>

            <a href="#prices" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>{{ __('home_messages.prices')}}</h4></a>
            <div class="collapse" id="prices">
                <a href="/price/index" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.allPrices')}}</a>
                <a href="/type/create" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.newPriceType')}}</a>
            </div>

            <a href="#sale" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>{{ __('home_messages.sales')}}</h4></a>
            <div class="collapse" id="sale">
                <a href="/sale/create" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.newSale')}}</a>
                <a href="/sale/index" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.salesHistory')}}</a>
            </div>

            @if ($role == 'admin')
                <a href="#users" data-toggle="collapse" class="list-group-item list-group-item-action"><h4>{{ __('home_messages.users')}}</h4></a>
                <div class="collapse" id="users">
                    <a href="/register" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.registerNewUser')}}</a>
                    <a href="/user/index" class="list-group-item list-group-item-action bg-info text-white">{{ __('home_messages.viewUsers')}}</a>
                </div>           
            @endif
        </div>
    </div>
@endsection
