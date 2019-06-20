<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use App\Branch;
Use Carbon\Carbon;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function home()
    {
        return redirect('/dashboard');
    }

    public function dashboard()
    {
        $appointments = Appointment::whereDate('start', Carbon::today())
                ->whereDate('end', Carbon::today()) 
                ->where('branch_id',\Auth::user()->branch_id)
                ->get();

        return view('users.dashboard', compact('appointments'));
    }

    public function settings()
    {
        $branches = Branch::all();

        return view('users.settings', compact('branches'));
    }

    public function postSettings(Request $request)
    {

        $user = User::find(\Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->branch_id = $request->branch_id;
        $user->save();

        return back()->with(['message' => 'Settings Updated', 'message_type' => 'success']);
    }

    public function updatePassword(Request $request)
    {

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with(['message' => 'Password Updated', 'message_type' => 'info']);
    }

    public function updateRoles(Request $request)
    {
       $user = User::find($request->user_id);
        
        if($request->sales)
            $user->roles()->attach(1);
        else
            $user->roles()->detach(1);

        if($request->management)
            $user->roles()->attach(2);
        else
            $user->roles()->detach(2);

        if($request->admin)
            $user->roles()->attach(3);
        else
            $user->roles()->detach(3);

        $user->save();

        return back()->with(['message' => 'Roles Updated', 'message_type' => 'success']);
    }
}
