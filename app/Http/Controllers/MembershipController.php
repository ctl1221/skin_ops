<?php

namespace App\Http\Controllers;

use App\Membership;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memberships = Membership::with('breakdowns')->orderBy('name')->paginate(4);

        return view('memberships.index', compact('memberships'));
    }
}
