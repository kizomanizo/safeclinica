<?php

namespace App\Http\Controllers;
use App\Http\Models\File;

use App\Http\Models\Insurance;
use App\Http\Models\Service;
use App\Http\Models\Patient;

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
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
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
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/create')->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
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
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show($insurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function edit($insurance)
    {
        //the form for editing available insurances ilishaundwa ile
        $insurance = Insurance::find($insurance);
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/edit')->with('insurance', $insurance)->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Insurance  $insurance
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
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function destroy($insurance)
    {
        //Deletes data from the Database BEWARE OF THIS DOG
        $insurance = Insurance::destroy($insurance);
        $insurances = Insurance::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('insurances/index')->
        with('insurances', $insurances)->
        with('services', $services)->
        with('count', $count)->with('logo', $logo);
    }
}
