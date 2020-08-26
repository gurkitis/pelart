<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        return view('user_index', ['users' => $users]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
