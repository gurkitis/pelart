<?php

namespace App\Http\Controllers;

use App\Buy_price;
use App\Sale_price;
use App\Product;
use App\Price_type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $buyPrice = Buy_price::where([['product_id', $id], ['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->get();
        if (!empty($buyPrice[0])) {
            $buyPrice = $buyPrice[0]->value;
            $buyPrice = number_format($buyPrice, 2);
            $buyPrice = $buyPrice.' eur';
        } else {
            $buyPrice = __('product_show_messages.noPrice');
        }
        
        
        $sellTypes = Price_type::all();
        $sellPrices = array();
        foreach ($sellTypes as $sellType)
        {
            $sellPrice = Sale_price::where([['product_id', $id], ['price_type_id', $sellType['id']], ['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->get();
            if (!empty($sellPrice[0])) {
                $sellPrice = $sellPrice[0]->value;
                $sellPrice = number_format($sellPrice, 2);
                $sellPrice = $sellPrice.' eur';
            } else {
                $sellPrice = __('product_show_messages.noPrice');
            }
            $sellPrices[$sellType['name']] = $sellPrice;
        }
        $product = Product::find($id);
        return view('product_show', ['buyPrice' => $buyPrice, 'sellPrices' => $sellPrices, 'product' => $product]);
    }

    public function edit(Request $request)
    {
        $rules = array(
            'product_id' => 'required|numeric|exists:products,id',
            'product_nr' => 'unique:products,product_nr|string|nullable',
            'product_name' => 'string|nullable',
            'volume' => 'numeric|min:1|nullable'
        );

        $this->validate($request, $rules);

        $product = Product::find($request['product_id']);

        if ($request['product_nr'])
        {
            $product->product_nr = $request['product_nr'];
        }
        if ($request['product_name'])
        {
            $product->name = $request['product_name'];
        }
        if ($request['volume'])
        {
            $product->volume = $request['volume'];
        }
        $product->save();
        return back();
    }
}
