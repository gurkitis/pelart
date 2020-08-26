<?php

namespace App\Http\Controllers;

use App\Price_type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('type_create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'type_name' => 'required|string|min:1|unique:price_types,name'
        );

        $this->validate($request, $rules);

        $type = new Price_type();
        $type->name = $request['type_name'];
        $type->save();

        return redirect('/');
    }
}
