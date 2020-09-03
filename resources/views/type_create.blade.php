@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>{{ __('type_create_messages.createNewPriceType') }}</h2>
            </li>
            <li class="list-group-item">
                <form action="/type/store" method="POST">
                    @csrf
                    <div class="row">
                        <label for="type_name">{{ __('type_create_messages.typeName') }} : </label>
                        <input type="text" name="type_name">
                    </div>
                    <div class="row">
                        <input class="btn btn-primary" type="submit" value="{{ __('type_create_messages.submit') }}">
                    </div>
                    @if (!$errors->isEmpty())
                        <span style="color:red;font-weight:bold">{{ __('type_create_messages.invalidInput') }}</span>
                    @endif
                </form>
            </li>
        </div>
    </div>
@endsection