<?php

namespace App\Http\Controllers;

use App\Price_type;
use App\Product;
use App\Sale;
use App\Sale_price;
use Illuminate\Http\Request;

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $products = Product::has('sale_price')->get();
        return view('sale_create', ['products' => $products]);
    }

    public function getOptions(Request $request)
    {
        $product = Product::find($request['product_id']);
        $sale_prices = $product->sale_price;
        $type_ids = array();
        foreach ($sale_prices as $sale_price)
        {
            $type_id = Price_type::find($sale_price->price_type_id)->id;
            array_push($type_ids, $type_id);
        }
        $type_ids = array_unique($type_ids);
        $type_names = array();
        foreach ($type_ids as $id)
        {
            $type_name = array('id' => $id, 'name' => Price_type::find($id)->name);
            array_push($type_names, $type_name);
        }
        return response()->json(['type_names' => $type_names], 200);
    }

    public function getPrice(Request $request)
    {
        $sale_price = Sale_price::where([['product_id', $request['product_id']], ['price_type_id', $request['price_type_id']], ['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->first()->value;
        return response()->json(['price' => $sale_price], 200);
    }

    public function store(Request $request)
    {
        $rules = array(
            'date' => 'required|date'
        );
        for ($i=0; $i < $request->count; $i++)
        { 
            $rules['product_id_'.$i] = 'required|numeric|min:0|exists:products,id';
            $rules['sell_type_id_'.$i] = 'required|numeric|min:0|exists:price_types,id';
            $rules['quantity_'.$i] = 'required|numeric|min:0';
        }

        $this->validate($request, $rules);

        for ($i=0; $i < $request->count; $i++)
        {
            $sale = new Sale();
            $sale->product()->associate(Product::find($request['product_id_'.$i]));
            $sale->quantity = $request['quantity_'.$i];
            $sale->sold_at = $request['date'];
            $sale->price_type_id = $request['sell_type_id_'.$i];
            $sale->save();

            $product = Product::find($request['product_id_'.$i]);
            $product->quantity -= $sale->quantity;
            $product->save();
        }

        return redirect('/');
    }

    public function index()
    {
        $dates = Sale::all()->groupBy('sold_at');
        $history = array();
        foreach ($dates as $date)
        {
            $elem = array('date' => $date[0]->sold_at);
            $sum = 0.00;
            foreach ($date as $sale)
            {
                $price = Sale_price::where([['product_id', $sale->product_id], ['price_type_id', $sale->price_type_id], ['active_from', '<=', $sale->sold_at]])->orderBy('active_from', 'desc')->first()->value;
                $sum += $price * $sale->quantity;
            }
            $elem['sum'] = number_format($sum, 2); 
            array_push($history, $elem);   
        }
        console_log($history);
        return view('sale_index', ['dates' => $history]);
    }

    public function show($date)
    {
        $sales = Sale::where('sold_at', $date)->get();
        $total = 0.00;
        $data = array();
        foreach ($sales as $sale)
        {
            $elem = array();
            $product = Product::find($sale->product_id);
            $price = Sale_price::where([['product_id', $sale->product_id], ['price_type_id', $sale->price_type_id], ['active_from', '<=', $sale->sold_at]])->orderBy('active_from', 'desc')->first()->value;
            $type_name = Price_type::find($sale->price_type_id)->name;
            $elem['sale_id'] = $sale->id;
            $elem['product_nr'] = $product->product_nr;
            $elem['name'] = $product->name;
            $elem['quantity'] = $sale->quantity;
            $elem['type_name'] = $type_name;
            $elem['price'] = $price;
            $elem['total'] = number_format($price * $sale->quantity, 2);
            $total += $elem['total'];
            array_push($data, $elem);
        }
        console_log($data);
        return view('sale_show', ['data' => $data, 'total' => $total, 'date' => $date]);
    }

    public function delete($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return back();
    }
}
