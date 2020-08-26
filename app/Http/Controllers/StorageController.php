<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        if (!isset($products[0])) {
            $products = NULL;
        }
        return view('storage_index', ['products' => $products]);
    }

    public function create()
    {
        return view('storage_create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'product_nr' => 'required|unique:products,product_nr|string',
            'product_name' => 'required|string',
            'volume' => 'required|numeric|min:1'
        );

        $this->validate($request, $rules);

        $product = new Product();

        $product->product_nr = $request['product_nr'];
        $product->name = $request['product_name'];
        $product->volume = $request['volume'];
        $product->save();

        return redirect('/storage/index');
    }
}
