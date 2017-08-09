<?php

namespace App\Http\Controllers;

use App\Http\Models\Investigation;
use App\Http\Models\Service;
use App\Http\Models\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class investigationController extends Controller
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
        //List all available investigations
        $investigations = Investigation::paginate(10);
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/index')->
        with('investigations', $investigations)->
        with('services', $services)->with('count', $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/create')->
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
        'name' => 'required|unique:investigations|max:50',
        'price' => 'required|integer|max:900000',
        ]);
        // The investigation is valid, store in database
        $investigation = new Investigation;
        $investigation->name = $request->name;
        $investigation->price = $request->price;
        $investigation->type = $request->type;
        $investigation->user = Auth::user()->name;
        $investigation->save();
        $investigations = Investigation::paginate(10);
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/index')->
        with('investigations', $investigations)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Investigation $investigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit($investigation)
    {
        //the form for editing available investigations ilishaundwa ile
        $investigation = Investigation::find($investigation);
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/edit')->
        with('investigation', $investigation)->
        with('services', $services)->with('count', $count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $investigation)
    {
        // Validate the request...
        $this->validate($request, [
            'name' => 'required|max:50',
            'price' => 'required|integer|max:900000',
        ]);
        // The investigation is valid, store in database...
        $investigation = Investigation::find($investigation);
        $investigation->name = $request->name;
        $investigation->price = $request->price;
        $investigation->type = $request->type;
        $investigation->user = $request->user;
        $investigation->created_at = $request->created_at;
        $investigation->updated_at = date("Y-m-d H:i:s");
        $investigation->save();
        $investigations = Investigation::paginate(10);
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/index')->
        with('investigations', $investigations)->
        with('services', $services)->
        with('count', $count);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy($investigation)
    {
        //Deletes data from the Database BEWARE OF THIS DOG
        $investigation = Investigation::destroy($investigation);
        $investigations = Investigation::all();
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('investigations/index')->
        with('investigations', $investigations)->
        with('services', $services)->
        with('count', $count);
    }
}
