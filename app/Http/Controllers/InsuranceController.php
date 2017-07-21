<?php

namespace App\Http\Controllers;

use App\Insurance;
use App\Service;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all available insurances
        $insurances = Insurance::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Load the adding page
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/create')->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Request validation
        $this->validate($request, [
        'name' => 'required|unique:insurances|max:50',
        ]);
        // The insurance is valid, store in database
        $insurance = new Insurance;
        $insurance->name = $request->name;
        $insurance->user = Auth::user()->name;
        $insurance->save();
        $insurances = Insurance::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show($insurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function edit($insurance)
    {
        //the form for editing available insurances ilishaundwa ile
        $insurance = Insurance::find($insurance);
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/edit')->with('insurance', $insurance)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $insurance)
    {
        // Validate the request...
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);
        // The insurance is valid, store in database...
        $insurance = Insurance::find($insurance);
        $insurance->name = $request->name;
        $insurance->user = $request->user;
        $insurance->created_at = $request->created_at;
        $insurance->updated_at = date("Y-m-d H:i:s");
        $insurance->save();
        $insurances = Insurance::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function destroy($insurance)
    {
        //Deletes data from the Database BEWARE OF THIS DOG
        $insurance = insurance::destroy($insurance);
        $insurances = insurance::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->get();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count);
    }
}
