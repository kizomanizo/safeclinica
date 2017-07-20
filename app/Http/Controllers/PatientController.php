<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Insurance;
use App\Service;
use App\Transaction;
use App\Treatment;
use App\Investigation;
use App\Patient_treatment;
use App\Patient_service;
use App\Patient_investigation;
use App\Patient_insurance;
use App\Patient_payment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Loads the page for adding a new patient
        $insurances = Insurance::All();
        $services = Service::All();
        if (count($services)>0) {
            return view('patients/create')->with('insurances', $insurances)->with('services', $services);
        }
        else {
            return view('/settings')->with('services', $services);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // The validation of the form
        $this->validate($request, [
        'number' => 'integer|nullable|digits:10',
        'fullname' => 'required|max:50',
        'age' => 'required|integer',
        ]);

        //Check if a patient number has been entered
        // The added patient is valid, store in database
        $patient = new Patient;
        if (empty($request->number)) {
            $patient->uid = date('ymdhs');
        }
        else {
            $patient->uid = $request->number;
        }
        // $patient->uid = date('y-m-d').'-'.$request->number;
        $patient->name = $request->fullname;
        $patient->age = $request->age;
        $patient->sex = $request->sex;
        $patient->user = Auth::user()->name;
        $patient->save();
        //Populate the patient_service table now
        $patient_service = New Patient_service;
        $patient_service->patient_id = $patient->id;
        $patient_service->service_id = $request->service;
        $patient_service->user = Auth::user()->name;
        $patient_service->status = 1;
        $patient_service->save();

        $patient_insurance = New Patient_insurance;
        $patient_insurance->patient_id = $patient->id;
        $patient_insurance->insurance_id = $request->payment;
        $patient_insurance->card = $request->card;
        $patient_insurance->user = Auth::user()->name;
        $patient_insurance->save();

        //Go back to the patient registration
        $insurances = Insurance::All();
        $services = Service::All();
        return view('patients/create')->with('insurances', $insurances)->with('services', $services);
    }

    public function test()
    {
        $id = 2;
        $test = Service::find($id);
        $result = $test->insurance;
        return($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        // List all patients in a select service ward
        $services = Service::All();
        $treatments = Treatment::All();
        $investigations = Investigation::All();
        return view('patients/show')->with('services', $services)->with('patient', $patient)->with('treatments', $treatments)->with('investigations', $investigations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

    public function treatments(Request $request, Patient $patient)
    {
        $patient = $request->patient;
        $patient = Patient::find($patient);
        $patient_id = $patient->id;
        $treatments = $request->treatments;
        $investigations = $request->investigations;
        $service = $request->service;
        $tablets = $request->tablets;
        $treatmentErrors = array_filter($treatments);
        $investigationErrors = array_filter($investigations);
        $tablets = array_filter($tablets);

        if (!empty($service)) {
        foreach ($services as $key => $n) {
        $patient_service = New Patient_service;
        $patient_service->patient_id = $patient->id;
        $patient_service->service_id = $services[$key];
        $patient_service->user = Auth::user()->name;
        $patient_service->status = 1;
        $patient_service->save();
        }}

                
        foreach ($treatments as $key => $n) {
        if (!empty($treatmentErrors)) {
            // The validation of the form
            $patient_treatment = New Patient_treatment;
            $treatment_payment = Treatment::where('id', $treatments[$key])->first();
            $treatment_payment = $treatment_payment->price * $tablets[$key];
            $patient_treatment->patient_id = $patient->id;
            $patient_treatment->treatment_id = $treatments[$key];
            $patient_treatment->treatment_tablets = $tablets[$key];
            $patient_treatment->treatment_payment = $treatment_payment;
            $patient_treatment->user = Auth::user()->name;
            $patient_treatment->status = 1;
            $patient_treatment->save();
        }}

        if (!empty($investigationErrors)) {
        foreach ($investigations as $key => $n) {
            $patient_investigation = New Patient_investigation;
            $patient_investigation->patient_id = $patient->id;
            $patient_investigation->investigation_id = $investigations[$key];
            $patient_investigation->user = Auth::user()->name;
            $patient_investigation->status = 1;
            // $patient_investigation->save();
        }}        

        $services = Service::   All('name', 'id');
        $patient = Patient::find($patient_id);

        $servs = $patient->services()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            get();

        $treatments = $patient->treatments()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            get();

        $investigations = $patient->
            investigations()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            get();

        $insurances = $patient->
            insurances()->
            where('patient_id', $patient_id)->
            get()->first();

        $prices = array(
            'iprice' => $patient->investigations()->
                where('patient_id', $patient_id)->
                wherePivot('status', '=', 1)->
                sum('price'), 
            'tprice' => $patient->treatments()->
                where('patient_id', $patient_id)->
                wherePivot('status', '=', 1)->
                sum('treatment_payment')

            );
        if ($insurances->name == 'Cash') {
            $sprice = $patient->services()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            sum('cash');
                }
        else {
            $sprice = $patient->services()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            sum('insurance');
            }

        $iprice = $patient->investigations()->
            where('patient_id', $patient_id)->
            wherePivot('status', '=', 1)->
            sum('price');
        return view('patients/index')->
            with('patient', $patient)->
            with('services', $services)->
            with('insurances', $insurances)->
            with('prices', $prices)->
            with('sprice', $sprice);
    }

    public function transactions(Request $request)
    {
        # receive arrays...
        $services = $request->services;
        $treatments = $request->treatments;
        $investigations = $request->investigations;
        $patient = $request->patient;
        $patient = Patient::where('id', $patient)->first();
        $insurance = $patient->insurances->first();
        $servicesArray = array_filter($services);
        $treatmentsArray = array_filter($treatments);
        $investigationsArray = array_filter($investigations);

        if (!empty($servicesArray)) {
        foreach ($services as $service => $n)
            {
                $transaction = New Transaction;
                $transaction->patient_id = $patient->id;
                $transaction->type = 'service';
                $transaction->type_id = $servicesArray[$service];
                if ($insurance->name == 'Cash')
                    {
                        $price = Service::where('id', $servicesArray[$service])->get()->first();
                        $price = $price->cash;
                    }
                else
                    {
                        $price = Service::where('id', $servicesArray[$service])->get()->first();
                        $price = $price->insurance;
                    }
                $transaction->type_price = $price;
                $transaction->user = Auth::user()->name;
                $transaction->save();
            }
        }

        foreach ($treatments as $treatment => $n)
            {
                $transaction = New Transaction;
                $transaction->patient_id = $patient->id;
                $transaction->type = 'treatment';
                $transaction->type_id = $treatmentsArray[$treatment];
                $price = $patient->treatments()->
                    wherePivot('patient_id', $patient->id)->
                    wherePivot('treatment_id', $treatmentsArray[$treatment])->
                    first();
                $price = $price->pivot->treatment_payment;
                $transaction->type_price = $price;
                $transaction->user = Auth::user()->name;
                $transaction->save();
            }

        foreach ($investigations as $investigation => $n)
            {
                $transaction = New Transaction;
                $transaction->patient_id = $patient->id;
                $transaction->type = 'investigation';
                $transaction->type_id = $investigationsArray[$investigation];
                $price = Investigation::where('id', $investigationsArray[$investigation])->get()->first();
                $price = $price->price;
                $transaction->type_price = $price;
                $transaction->user = Auth::user()->name;
                $transaction->save();
            }
        $patient_payment = New Patient_payment;
        if (count($request->paidamount)>0) {
            $payment = $request->paidamount;
        }
        else {
            $payment = $request->payment;
        }
        $patient_payment->patient_id = $patient->id;
        $patient_payment->paid = $payment;
        $patient_payment->status = 1;
        $patient_payment->user = Auth::user()->name;
        $patient_payment->save();
        return count($request->paidamount);
    }
}

