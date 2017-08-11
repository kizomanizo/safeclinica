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

    public function welcome()
    {
        return redirect()->route('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */    public function index()
    {
        return view('static/home');
    }

    public function settings()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('static/settings')->
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

    public function logo(Request $request)
    {
        // Validate the logo if it is an image and if it fits the size
        $this->validate($request, [
            'logo' => 'required|image|dimensions:max=600,max_height=200',
        ]);

        $logopath = $request->file('logo')->store('logos');

        return $logopath;
    }
}
