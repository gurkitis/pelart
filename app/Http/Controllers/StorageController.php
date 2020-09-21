<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'volume' => 'required|numeric|min:1',
            'input_img' => 'image'
        );

        $this->validate($request, $rules);

        $product = new Product();

        $product->product_nr = $request['product_nr'];
        $product->name = $request['product_name'];
        $product->volume = $request['volume'];
        $product->save();

        $product = Product::where('product_nr', $request['product_nr'])->get()[0];

        if ($request->hasFile('input_img')) {
            $img_name = $product->id.'.'.$request->input_img->getClientOriginalExtension();
            $request->input_img->move(public_path('storage/product_img'), $img_name);
            $product->img_name = $img_name;
            $product->save();
        }

        return redirect('/product/'.$product->id);
    }
}
