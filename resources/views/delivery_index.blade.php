@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>{{ __('delivery_index_messages.deliveryHistory')}}</h2>
            </li>
            @foreach ($dates as $date)
                <a class="list-group-item list-group-item-action" href="/delivery/show/{{ $date[0] }}">
                    <h4>{{ $date[0] }}<br>{{ __('delivery_index_messages.total')}} : {{ $date[1] }} eur</h4>
                </a>
            @endforeach
        </div>
    </div>
@endsection