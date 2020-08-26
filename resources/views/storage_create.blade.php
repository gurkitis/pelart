@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-group ">
            <li class="list-group-item active">
                <h2>Add new product</h2>
            </li>
            <li class="list-group-item">
                <form action="/storage/store" method="POST">
                    @csrf
                    <label for="product_nr">Product nr : </label>
                    <input type="text" name="product_nr">
                    @if ($errors->has('product_nr'))
                        <span style="color:red;font-weight:bold">Invalid input</span>
                    @endif
                    <br>

                    <label for="product_name">Product name : </label>
                    <input type="text" name="product_name">
                    @if ($errors->has('product_name'))
                        <span style="color:red;font-weight:bold">Invalid input</span>
                    @endif
                    <br>

                    <label for="volume">Volume : </label>
                    <input type="number" min="1" name="volume"> ml
                    @if ($errors->has('volume'))
                        <span style="color:red;font-weight:bold">Invalid input</span>
                    @endif
                    <br>
                    <input type="submit" value="Add">
                </form>
            </li>
        </div>
    </div>
@endsection