<?php

namespace App\Http\Controllers;

use App\Buy_price;
use App\Price_type;
use App\Product;
use App\Sale_price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return view('price_index', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $price_types = Price_type::all();

        $all_sale_prices = array();
        foreach ($price_types as $price_type)
        {
            $type_prices['type'] = $price_type;
            $type_prices['all_sale_prices'] = Sale_price::where([['product_id', $id], ['price_type_id', $price_type->id]])->orderBy('active_from', 'desc')->get();
            $type_prices['sale_price_now'] = Sale_price::where([['product_id', $id], ['price_type_id', $price_type->id], ['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->first();
            $all_sale_prices[$price_type->name] = $type_prices;
        }
        $buy_price = Buy_price::where([['product_id', $id], ['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->first();
        $all_buy_prices = Buy_price::where('product_id', $id)->orderBy('active_from', 'desc')->get();
        return view('price_show', [
            'product' => $product,
            'price_types' => $price_types,
            'buy_price_now' => $buy_price, 
            'all_buy_prices' => $all_buy_prices,  
            'all_sale_prices' => $all_sale_prices
            ]);
    }

    public function store_buy(Request $request)
    {
        $rules = array(
            'date' => 'required|date',
            'value' => 'required|numeric|min:0',
            'id' => 'required|numeric|min:0|exists:products,id'
        );

        $this->validate($request, $rules);

        $price = new Buy_price();
        $price->product_id = $request['id'];
        $price->value = $request['value'];
        $price->active_from = $request['date'];
        $price->save();
        
        return back();
    }

    public function edit_buy(Request $request)
    {
        $rules = array(
            'buy_id' => 'required|numeric|min:0|exists:buy_prices,id',
            'date' => 'date|nullable',
            'value' => 'numeric|min:0|nullable'
        );

        $this->validate($request, $rules);

        $price = Buy_price::find($request['buy_id']);
        if ($request['date']) 
        {
            $price->active_from = $request['date'];
        }
        if ($request['value'])
        {
            $price->value = $request['value'];
        }
        $price->save();
        return back();
    }

    public function delete_buy($id)
    {
        $price = Buy_price::find($id);
        $price->delete();
        return back();
    }

    public function store_sale(Request $request)
    {
        $rules = array(
            'product_id' => 'required|numeric|min:0|exists:products,id',
            'type_id' => 'required|numeric|min:0|exists:price_types,id',
            'date' => 'required|date',
            'value' => 'required|numeric|min:0'
        );

        $this->validate($request, $rules);

        $price = new Sale_price();
        $price->product_id = $request['product_id'];
        $price->price_type_id = $request['type_id'];
        $price->active_from = $request['date'];
        $price->value = $request['value'];
        $price->save();

        return back();
    }

    public function edit_sale(Request $request)
    {
        $rules = array(
            'sale_id' => 'required|numeric|exists:sale_prices,id',
            'date' => 'date|nullable',
            'value' => 'numeric|min:0|nullable'
        );

        $this->validate($request, $rules);

        $price = Sale_price::find($request['sale_id']);
        if ($request['date'])
        {
            $price->active_from = $request['date'];
        }
        if ($request['value'])
        {
            $price->value = $request['value'];
        }
        $price->save();

        return back();
    }

    public function delete_sale($id)
    {
        $price = Sale_price::find($id);
        $price->delete();
        return back();
    }
}
