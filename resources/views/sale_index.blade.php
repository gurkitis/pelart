@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>Sales history</h2>
            </li>
            @foreach ($dates as $date)
                <a class="list-group-item list-group-item-action" href="/sale/show/{{ $date['date'] }}">
                    <h4>{{ $date['date'] }}<br>Total : {{ $date['sum'] }}eur</h4>
                </a>
            @endforeach
        </div>
    </div>
@endsection