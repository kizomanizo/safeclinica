<?php

namespace App\Http\Controllers;

use App\Http\Models\Treatment;
use App\Http\Models\Service;
use App\Http\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class treatmentController extends Controller
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
        //List all available treatments
        $treatments = Treatment::all();
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/index')->
            with('treatments', $treatments)->
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
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/create')->
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
        'name' => 'required|unique:treatments|max:50',
        'price' => 'required|integer|max:900000',
        ]);
        // The treatment is valid, store in database
        $treatment = new Treatment;
        $treatment->name = $request->name;
        $treatment->price = $request->price;
        $treatment->user = Auth::user()->name;
        $treatment->save();
        $treatments = Treatment::all();
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/index')->
            with('treatments', $treatments)->
            with('services', $services)->
            with('count', $count);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit($treatment)
    {
        //the form for editing available treatments ilishaundwa ile
        $treatment = Treatment::find($treatment);
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/edit')->
            with('treatment', $treatment)->
            with('services', $services)->
            with('count', $count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $treatment)
    {
        // Validate the request...
        $this->validate($request, [
            'name' => 'required|max:50',
            'price' => 'required|integer|max:900000',
        ]);
        // The treatment is valid, store in database...
        $treatment = Treatment::find($treatment);
        $treatment->name = $request->name;
        $treatment->price = $request->price;
        $treatment->user = $request->user;
        $treatment->created_at = $request->created_at;
        $treatment->updated_at = date("Y-m-d H:i:s");
        $treatment->save();
        $treatments = Treatment::all();
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/index')->
            with('treatments', $treatments)->
            with('services', $services)->
            with('count', $count);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy($treatment)
    {
        //Deletes data from the Database BEWARE OF THIS DOG
        $treatment = Treatment::destroy($treatment);
        $treatments = Treatment::all();
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        return view('treatments/index')->
            with('treatments', $treatments)->
            with('services', $services)->
            with('count', $count);
    }
}
