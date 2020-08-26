<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $price = Price::where('product_nr', $id)->get()[0];
        $product = Product::where('nr', $id)->get()[0];
        return view('product_show', ['price' => $price, 'product' => $product]);
    }
}
