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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

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
        return view('patients/create')->with('insurances', $insurances)->with('services', $services);
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
        'card' => 'numeric|min:900',
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
        $patient->payment_id = $request->payment;
        $patient->card = $request->card;
        $patient->user = Auth::user()->name;
        $patient->save();
        //Populate the patient_service table now
        $patient_service = New Patient_service;
        $patient_service->patient_id = $patient->id;
        $patient_service->service_id = $request->service;
        $patient_service->user = Auth::user()->name;
        $patient_service->status = 1;
        $patient_service->save();

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
        $treatments = $request->treatments;
        $investigations = $request->investigations;
        $service = $request->service;
        $treatmentErrors = array_filter($treatments);
        $investigationErrors = array_filter($investigations);

        if (!empty($service)) {
        $patient_service = New Patient_service;
        $patient_service->patient_id = $patient->id;
        $patient_service->service_id = $service;
        $patient_service->user = Auth::user()->name;
        $patient_service->status = 1;
        $patient_service->save();
        }

        if (!empty($treatmentErrors)) {
        foreach ($treatments as $key => $n) {
            $patient_treatment = New Patient_treatment;
            $patient_treatment->patient_id = $patient->id;
            $patient_treatment->treatment_id = $treatments[$key];
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
            $patient_investigation->save();
        }}

        // Loads the page for adding a new patient
        $services = Service::   All('name', 'id');
        $patient_services =     Patient_service::get()->where('patient_id', $patient->id);
        $patient_treatments =   Patient_treatment::get()->where('patient_id', $patient->id);
        $servs = Patient::      leftJoin('patient_services', 'patients.id', '=', 'patient_services.patient_id')->
                                leftJoin('services', 'patient_services.service_id', '=', 'services.id')->
                                select('services.name as serv', 'services.cash')->
                                where('patients.id', '=', $patient->id)->
                                get();

        $treatments = Patient:: leftJoin('patient_treatments', 'patients.id', '=', 'patient_treatments.patient_id')->
                                leftJoin('treatments', 'patient_treatments.treatment_id', '=', 'treatments.id')->
                                select('treatments.name as treatment', 'treatments.price')->
                                where('patients.id', '=', $patient->id)->
                                get();
        $investigations = Patient:: 
                                leftJoin('patient_investigations', 'patients.id', '=', 'patient_investigations.patient_id')->
                                leftJoin('investigations', 'patient_investigations.investigation_id', '=', 'investigations.id')->
                                select('investigations.name as investigation', 'investigations.price')->
                                where('patients.id', '=', $patient->id)->
                                get();

        return                  view('patients/index')->
                                with('patient', $patient)->
                                with('services', $services)->
                                with('servs', $servs)->
                                with('treatments', $treatments)->
                                with('investigations', $investigations);
    }
}