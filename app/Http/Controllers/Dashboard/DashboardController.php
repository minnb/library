<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Log;
use Auth;
use App\Models\Roles;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
    	return view('dashboard.layouts.index');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }	
}
