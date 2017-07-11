<?php

namespace App\Http\Controllers;

use App\Service;
use App\Patient;
use App\Transaction;
use App\Patient_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all available services
        $services = Service::all();
        return view('services/index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('services/create')->with('services', $services);
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
        'name' => 'required|unique:services|max:50',
        'cash' => 'required|integer|max:900000',
        'insurance' => 'required|integer|max:900000',
        ]);
        // The service is valid, store in database
        $service = new Service;
        $service->name = $request->name;
        $service->cash = $request->cash;
        $service->insurance = $request->insurance;
        $service->user = Auth::user()->name;
        $service->save();
        $services = Service::all();
        return view('services/index')->with('services', $services);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($service)
    {
        $services = Service::all();
        $service = Service::find($service);
        $id = $service->id;
        $transactions = Patient_service::get()->where('service_id', $id)->where('status', 1);
        return view('services/show')->with('services', $services)->with('transactions', $transactions)->with('service', $service);
        // return($transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service)
    {
        //the form for editing available services ilishaundwa ile
        $services = Service::all();
        $service = Service::find($service);
        return view('services/edit')->with('service', $service)->with('services', $services);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service)
    {
        // Validate the request...
        $this->validate($request, [
            'name' => 'required|max:50',
            'cash' => 'required|integer|max:900000',
            'insurance' => 'required|integer|max:900000',
        ]);
        // The service is valid, store in database...
        $service = Service::find($service);
        $service->name = $request->name;
        $service->cash = $request->cash;
        $service->insurance = $request->insurance;
        $service->user = $request->user;
        $service->created_at = $request->created_at;
        $service->updated_at = date("Y-m-d H:i:s");
        $service->save();
        $services = Service::all();
        return view('services/index')->with('services', $services);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service)
    {
        //Deletes data from the Database BEWARE OF THIS DOG
        $service = Service::destroy($service);
        $services = Service::all();
        return view('services/index')->with('services', $services);
    }
}
