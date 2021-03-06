<?php

namespace App\Http\Controllers;
use App\Http\Models\File;

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
        $treatments = Treatment::paginate(10);
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('treatments/index')->
            with('treatments', $treatments)->
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
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('treatments/create')->
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
        'name' => 'required|unique:treatments|max:50',
        'price' => 'required|integer|max:900000',
        'drug' => 'required|max:50',
        'type' => 'required|max:50',
        ]);
        // The treatment is valid, store in database
        $treatment = new Treatment;
        $treatment->name = $request->name;
        $treatment->price = $request->price;
        $treatment->drug = $request->drug;
        $treatment->type = $request->type;
        $treatment->user = Auth::user()->name;
        $treatment->save();
        $treatments = Treatment::paginate(10);
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return redirect('treatments');
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
        $logo = File::where('name', 'logo')->first();
        return view('treatments/edit')->
            with('treatment', $treatment)->
            with('services', $services)->
            with('count', $count)->with('logo', $logo);
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
        $treatment->drug = $request->drug;
        $treatment->type = $request->type;
        $treatment->user = $request->user;
        $treatment->created_at = $request->created_at;
        $treatment->updated_at = date("Y-m-d H:i:s");
        $treatment->save();
        $treatments = Treatment::paginate(12);
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return redirect ('treatments');
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
        $treatments = Treatment::paginate(10);
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return redirect('treatments');
    }
}
