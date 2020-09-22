@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>{{ __('storage_create_messages.addNewProduct') }}</h2>
            </li>
            <li class="list-group-item">
                <form enctype="multipart/form-data" action="/storage/store" method="POST">
                    @csrf
                    <label for="product_nr">{{ __('storage_create_messages.productNr') }} : </label>
                    <input type="text" name="product_nr">
                    @if ($errors->has('product_nr'))
                        <span style="color:red;font-weight:bold">{{ __('storage_create_messages.invalidInput') }}</span>
                    @endif
                    <br>

                    <label for="product_name">{{ __('storage_create_messages.productName') }} : </label>
                    <input type="text" name="product_name">
                    @if ($errors->has('product_name'))
                        <span style="color:red;font-weight:bold">{{ __('storage_create_messages.invalidInput') }}</span>
                    @endif
                    <br>

                    <label for="volume">{{ __('storage_create_messages.volume') }} : </label>
                    <input type="number" min="1" name="volume"> ml
                    @if ($errors->has('volume'))
                        <span style="color:red;font-weight:bold">{{ __('storage_create_messages.invalidInput') }}</span>
                    @endif
                    <br>
                    
                    <label for="input_img">{{ __('storage_create_messages.image')}} : </label>
                    <input type="file" name="input_img" id="input_img">
                    @if ($errors->has('input_img'))
                        <span style="color:red;font-weight:bold">{{ __('storage_create_messages.invalidInput') }}</span>
                    @endif
                    <br>
                    <input type="submit" value="{{ __('storage_create_messages.add') }}">
                </form>
            </li>
        </div>
    </div>
@endsection