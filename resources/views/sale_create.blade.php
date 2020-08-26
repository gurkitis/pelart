@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/sale_create.js') }}" defer></script>
    <div class="container">
        <div class="list-group">
            <li class="list-group-item active">
                <h2>New sale</h2>
            </li>
            <form action="/sale/store" method="POST">
                @csrf
                <li class="list-group-item primary list-group-item-info">
                    <div class="row">
                        <div class="col-4">
                            <h4>Product</h4>
                        </div>
                        <div class="col-3">
                            <h4>Sell type</h4>
                        </div>
                        <div class="col">
                            <h4>Price per unit</h4>
                        </div>
                        <div class="col-2">
                            <h4>Quantity</h4>
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
                                <select name="product_id_0" onchange="getOptions(0)">
                                    <option value="NULL"></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->product_nr }}_{{ $product->name }}_{{ $product->volume }}ml
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="sell_type_id_0" onchange="getPrice(0)">
                                    <option value="NULL"></option>
                                </select>
                            </div>
                            <div class="col">
                                <p id="price_0">0 eur</p>
                            </div>
                            <div class="col-2">
                                <input type="number" name="quantity_0" value="0" min="0" oninput="outputChange(0)">
                            </div>
                            <div class="col">
                                <p id="sum_0">0 eur</p>
                            </div>
                        </div>
                    </li>
                </div>
                <div id="append_here">

                </div>
                <li class="list-group-item">
                    <input type="hidden" name="count" value="1" id="input_count">
                    <div class="row">
                        <div class="col">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                        <div class="col">
                            <label for="date">
                                <h5>Sale date </h5>
                            </label>
                            <input type="date" name="date">
                        </div>
                        <div class="col">
                            <input class="btn btn-primary" type="button" onClick="addRow()" value="Add item">
                        </div>
                        <div class="col">
                            <input class="btn btn-primary" type="button" onClick="deleteRow()" value="Delete item">
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