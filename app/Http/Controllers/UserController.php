<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use App\Branch;
use App\Sequence;
use App\SalesOrder;
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
        $branch = Branch::findOrFail(\Auth::user()->branch_id);

        $appointments = Appointment::whereDate('start', Carbon::today())
                ->whereDate('end', Carbon::today()) 
                ->where('branch_id', $branch->id)
                ->get();

        $quota = $branch->quota;
    
        $date_to = new Carbon('last day of this month');
        $current = $branch->currentMonthlySales($date_to)/$quota;
        $over = $current > 1 ? ($current - 1) : 0;

        $items =  $branch->monthlyItemSalesCount();

        return view('users.dashboard', compact('appointments','quota', 'current','over','items'));
    }

    public function settings()
    {
        $branches = Branch::all();

        return view('users.settings', compact('branches'));
    }

    public function systemSettings()
    {
        $date = Sequence::where('name','Date Lock End')->first()->text_value;
        $salesColor = Sequence::where('name','Sales Color')->first()->text_value;
        $claimColor = Sequence::where('name','Claim Color')->first()->text_value;
        $gaveColor = Sequence::where('name','Gave Color')->first()->text_value;
        $receivedColor = Sequence::where('name','Received Color')->first()->text_value;
        $paymentColor = Sequence::where('name','Payment Color')->first()->text_value;

        return view('users.system_settings', compact('date','salesColor','gaveColor','claimColor','receivedColor','paymentColor'));
    }

    public function postSystemSettings(Request $request)
    {

        $date = Sequence::where('name','Date Lock End')->first();
        $date->text_value = $request->date;
        $date->save();

        $color = Sequence::where('name','Sales Color')->first();
        $color->text_value = $request->sales_color;
        $color->save();

        $color = Sequence::where('name','Payment Color')->first();
        $color->text_value = $request->payment_color;
        $color->save();

        $color = Sequence::where('name','Claim Color')->first();
        $color->text_value = $request->claim_color;
        $color->save();

        $color = Sequence::where('name','Gave Color')->first();
        $color->text_value = $request->gave_color;
        $color->save();

        $color = Sequence::where('name','Received Color')->first();
        $color->text_value = $request->received_color;
        $color->save();


        return back()->with(['message' => 'System Settings Updated', 'message_type' => 'success']);
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

        if($request->it)
            $user->roles()->attach(4);
        else
            $user->roles()->detach(4);

        $user->save();

        return back()->with(['message' => 'Roles Updated', 'message_type' => 'success']);
    }
}
