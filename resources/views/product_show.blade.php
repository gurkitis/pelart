@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>Nr: {{ $product->nr }}<br>{{ $product->name }} {{ $product->volume }}ml</h2>
            </li>
            <li class="list-group-item">
                <h4></h4>
            </li>
        </div>
    </div>
@endsection