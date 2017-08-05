<?php

namespace App\Http\Controllers;
use App\Http\Models\Insurance;
use App\Http\Models\Service;
use App\Http\Models\Patient;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */    public function index()
    {
        return view('home');
    }

    public function settings()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('settings')->
            with('services', $services)->
            with('count', $count);
    }

    public function reports()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('reports')->
            with('services', $services)->
            with('count', $count);
    }

}
