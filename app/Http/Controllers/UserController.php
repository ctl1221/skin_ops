<?php

namespace App\Http\Controllers;

use App\User;

use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$users = User::all();

    	return view('users.index', compact('users'));
    }

    public function create()
    {
    	return view('users.create');
    }

    public function store(Request $request)
    {
    	Validator::make($request->all(), [
		    'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
		])->validate();

    	User::create([
    		'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
    	]);

    	return redirect('/users');

    }
}
