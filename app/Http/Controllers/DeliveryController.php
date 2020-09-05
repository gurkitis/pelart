<?php

namespace App\Http\Controllers;

use App\Product;
use App\Buy_price;
use App\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $products = Product::has('buy_price')->get();
        return view('delivery_create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $rules = array(
            'date' => 'required|date'
        );
        for ($i=0; $i < $request->count; $i++) 
        {
            $rules['product_id_'.$i] = 'required|exists:products,id';
            $rules['quantity_'.$i] = 'required|numeric|min:1';
            $rules['damaged_'.$i] = 'boolean';
        }
        $this->validate($request, $rules);

        for ($i=0; $i < $request->count; $i++) 
        { 
            $delivery = new Delivery();
            $delivery->delivered_at = $request['date'];
            $delivery->product()->associate(Product::findOrFail($request['product_id_'.$i]));
            $delivery->quantity = $request['quantity_'.$i];
            if ($request->boolean('dameged_'.$i))
            {
                $delivery->dameged = 1;
            }else{
                $delivery->dameged = 0;
                $product = Product::where('id', $request['product_id_'.$i])->get();
                $product[0]->quantity += $request['quantity_'.$i];
                $product[0]->save();
            }
            $delivery->save();
        }

        return redirect('/');
    }

    public function update(Request $request)
    {
        $price = Buy_price::where([['product_id', $request->id],['active_from', '<=', date('Y-m-d')]])->orderBy('active_from', 'desc')->first();
        return response()->json(['price' => $price->value, 'id' => $price->id], 200);
    }

    public function index()
    {
        $dates = Delivery::all()->groupBy('delivered_at');
        $history = array();
        foreach ($dates as $date) 
        {
            $elem = array($date[0]->delivered_at);
            $sum = 0.00;
            foreach ($date as $delivery) 
            {
                $price = Buy_price::where([['product_id', $delivery->product_id], ['active_from', '<=', $delivery->delivered_at]])->orderBy('active_from', 'desc')->first()->value;
                console_log($delivery);
                console_log($price);
                $sum = $sum + $price * $delivery->quantity;   
            }
            array_push($elem, $sum);
            array_push($history, $elem);
        }
        rsort($history);
        console_log($history);
        return view('delivery_index', ['dates' => $history]);
    }

    public function show($date)
    {
        $deliveries_raw = Delivery::where('delivered_at', $date)->get();
        $deliveries = array();
        $total = 0.00;
        $dameges = 0.00;
        foreach ($deliveries_raw as $delivery_raw) 
        {
            $delivery = array();
            $product = Product::find($delivery_raw->product_id);
            $delivery['product_nr'] = $product->product_nr;
            $delivery['quantity'] = $delivery_raw->quantity;
            $delivery['name'] = $product->name.'_'.$product->volume.'ml';
            $delivery['dameged'] = $delivery_raw->dameged;
            $price = Buy_price::where([['product_id', $delivery_raw->product_id], ['active_from', '<=', $delivery_raw->delivered_at]])->orderBy('active_from', 'desc')->first()->value;
            $delivery['price'] = $price;
            $sum = $price * $delivery_raw->quantity;
            $total += $sum;
            $delivery['sum'] = $sum;
            if ($delivery['dameged'] == 1)
            {
                $dameges += $sum;
            }
            $delivery['id'] = $delivery_raw->id;
            array_push($deliveries, $delivery); 
        }
        $real_total = number_format($total - $dameges, 2);
        return view('delivery_show', ['deliveries' => $deliveries, 'date' => $date, 'total' => $total, 'dameges' => $dameges, 'real_total' => $real_total]);
    }

    public function delete($id)
    {
        $delivery = Delivery::find($id);
        $delivery->delete();
        return back();
    }
}
