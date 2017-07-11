<?php

namespace App\Http\Controllers;
use App\Insurance;
use App\Service;

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
        return view('settings')->with('services', $services);
    }

}
