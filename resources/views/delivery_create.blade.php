@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/delivery_create.js') }}" defer></script>
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>New Delivery</h2>
            </li>
            <form action="/delivery/store" method="POST">
                @csrf
                <li class="list-group-item primary list-group-item-info">
                    <div class="row">
                        <div class="col-4">
                            <h4>Product</h4>
                        </div>
                        <div class="col">
                            <h4>Price per item</h4>
                        </div>
                        <div class="col">
                            <h4>Quantity</h4>
                        </div>
                        <div class="col">
                            <h4>Dameged?</h4>
                        </div>
                        <div class="col">
                            <h4>Total</h4>
                        </div>
                    </div>
                </li>
                <div id="0">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">
                                <select name="product_id_0" onchange="getPrice(0, this.value)">
                                    <option value="NULL"></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->product_nr }}_{{ $product->name }}_{{ $product->volume }}ml
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <input type="hidden" id="price_0" value="0">
                                <input type="hidden" name="buy_price_id_0">
                                <p id="show_price_0">0 eur</p>
                            </div>
                            <div class="col">
                                <input type="number" name="quantity_0" id="quantity_0" value="0" min="0" onChange="outputChange(0)">
                            </div>
                            <div class="col">
                                <input type="checkbox" name="dameged_0" >
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p id="sum_0">0 eur</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div id="append_here">

                </div>
                <li class="list-group-item">
                    <input type="hidden" name="count" value="1" id="input_count">
                    <div class="row">
                        <div class="col-4">
                            <label for="date">Delivery date </label>
                            <input type="date" name="date" >
                            <br>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                        <div class="col">
                            <input class="btn btn-primary" type="button" onClick="addRow()" value="Add item">
                            <input class="btn btn-primary" type="button" onClick="deleteRow()" value="Delete item">
                        </div>
                        <div class="col">
                            <a class="btn btn-primary" href="/storage/create">Add new product</a>
                        </div>
                        <div class="col">
                            <h4 id="total_sum">Grand total : 0 eur</h4>
                        </div>
                    </div>
                </li>
            </form>
            @if (!$errors->isEmpty())
                <span style="color:red;font-weight:bold">Invalid input</span>
            @endif
        </div>
    </div>
@endsection