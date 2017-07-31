<?php

namespace App\Http\Controllers;

use App\Http\Models\Patient;
use App\Http\Models\Insurance;
use App\Http\Models\Service;
use App\Http\Models\Treatment;
use App\Http\Models\Investigation;
use App\Http\Models\Patient_treatment;
use App\Http\Models\Patient_service;
use App\Http\Models\Patient_investigation;
use App\Http\Models\Patient_insurance;
use App\Http\Models\Patient_payment;
use App\Http\Models\Patient_transaction;
use App\Http\Models\Region;
use App\Http\Models\District;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $region_id = $request->region_id;
        $districts = District::where('region_id', $region_id)->get();
        return $districts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Loads the page for adding a new patient
        $insurances = Insurance::All('id', 'name');
        $services = Service::All('id', 'name');
        $count = Patient::where('status', 1)->count();
        $location = array(
            'regions' => Region::All(),
            'districts' => District::All()
            );
        
        if (count($services)>0) {
            return view('patients/create')->
                with('insurances', $insurances)->
                with('services', $services)->
                with('count', $count)->
                with('location', $location);
        }
        else {
            return view('/settings')->
                with('services', $services)->
                with('count', $count);
        }
    }

    /**
     * A method to pull all districts for a given region
     * @return [array] [districts]
     */
    public function ajaxdistricts(Request $request)
    {
        $region_id = $request->region_id;
        $districts = District::where('region_id', $region_id)->get();
        return $districts;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @todo Pop an alert after a new patient has been registered @done
     */
    public function store(Request $request)
    {
        // The validation of the form
        $this->validate($request, [
        'number' => 'integer|nullable',
        'fullname' => 'required|max:50',
        'age' => 'required|integer',
        'district' => 'required',
        ]);

        #register nrew patient
        $patient = new Patient;
        $patient->name = $request->fullname;
        $patient->age = $request->age;
        $patient->sex = $request->sex;
        $patient->district_id = $request->district;
        if(!empty($request->village)) {
            $patient->village = $request->village;
        }
        else {
            $patient->village = 'Unknown';
        }
        $patient->status = 1;
        $patient->user = Auth::user()->name;
        $patient->save();
        
        #generate uid
        $id = $patient->id;
        if($id<100) {$var='0000'.$id;}
        elseif($id>=100 && $id<1000){$var='000'.$id;}
        elseif($id>=1000 && $id<10000){$var='00'.$id;}
        elseif($id>=10000 && $id<100000){$var='0'.$id;}
        else{$var=$id;}
        $uid = substr(chunk_split($var, 2, '-'), 0, -1);
        $uid_patient = Patient::where('id', $id)->first();
        $uid_patient->uid = $uid;
        $uid_patient->save();

        //Populate the patient_service table now
        $patient_service = New Patient_service;
        $patient_service->patient_id = $patient->id;
        $patient_service->service_id = $request->service;
        $patient_service->user = Auth::user()->name;
        $patient_service->status = 1;
        $patient_service->save();

        # Add the payment type and/or insurance card to patient_insurance table
        $patient_insurance = New Patient_insurance;
        $patient_insurance->patient_id = $patient->id;
        $patient_insurance->insurance_id = $request->payment;
        $patient_insurance->card = $request->card;
        $patient_insurance->user = Auth::user()->name;
        $patient_insurance->save();

        #Return to the patient registering page for more patients
        $insurances = Insurance::All();
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $registered = Patient::where('id', $patient->id)->first();
        return view('patients/create')->
            with('insurances', $insurances)->
            with('services', $services)->
            with('count', $count)->
            with('registered', $registered)->
            with('location', $this->create()->location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        // List the page for serving a specific client.
        $services = Service::All();
        $count = Patient::where('status', 1)->count();
        $patient_status = Patient_service::where('patient_id', $patient->id)->first();
        $data = array(
            'services' => Service::All('id', 'name'),
            'patient' => Patient::where('id', $patient->id)->first(),
            'treatments' => Treatment::All('id', 'name'),
            'investigations' => Investigation::All('id', 'name')
        );
        if($patient_status->status == 1)
            {
                return view('patients/show')->
                    with('services', $services)->
                    with('data', $data)->
                    with('count', $count);
            }
        else
            {

                $patient = Patient::find($patient)->first();
                $patient_id = $patient->id;
                $patient = Patient::find($patient_id);
                $servs = $patient->services()->
                    where('patient_id', $patient_id)->
                    get();

                $treatments = $patient->treatments()->
                    where('patient_id', $patient_id)->
                    get();

                $investigations = $patient->investigations()->
                    where('patient_id', $patient_id)->
                    wherePivot('status', '=', 1)->
                    get();

                $insurances = $patient->insurances()->
                    where('patient_id', $patient_id)->
                    get()->
                    first();

                if ($insurances->name == 'Cash')
                {
                    $sprice = $patient->services()->
                    where('patient_id', $patient_id)->
                    sum('cash');
                }
                else
                {
                    $sprice = $patient->services()->
                    where('patient_id', $patient_id)->
                    sum('insurance');
                }

                $prices = array(
                    'iprice' =>$patient->investigations()->
                        where('patient_id', $patient_id)->
                        sum('price'), 
                    'tprice' =>$patient->treatments()->
                        where('patient_id', $patient_id)->
                        sum('treatment_payment'),
                    'sprice' =>$sprice
                    );

                return view('patients/index')->
                    with('patient', $patient)->
                    with('services', $services)->
                    with('insurances', $insurances)->
                    with('prices', $prices)->
                    with('count', $count);

                // return $iprice;
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Patient  $patient
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
     * @param  \App\Http\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

    public function release(Request $request, Patient $patient)
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
            $patient_treatment->treatment_tablet = $tablets[$key];
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
            $patient_investigation->save();
        }}        

        $services = Service::All('name', 'id');
        $patient = Patient::find($patient_id);
        $count = Patient::where('status', 1)->count();

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

        $prices = array(
            'iprice' => $patient->investigations()->
                where('patient_id', $patient_id)->
                wherePivot('status', '=', 1)->
                sum('price'), 
            'tprice' => $patient->treatments()->
                where('patient_id', $patient_id)->
                wherePivot('status', '=', 1)->
                sum('treatment_payment'),
            'sprice' => $sprice
            );

        # Update the status in the patient services, treatments and investigation table
        Patient_service::where('patient_id', $patient_id)->
            update(['status' => 0]);
        Patient_treatment::where('patient_id', $patient_id)->
            update(['status' => 0]);
        Patient_investigation::where('patient_id', $patient_id)->
            update(['status' => 0]);

        #Return the page that lists the summary of costs incurred
        return view('patients/index')->
            with('patient', $patient)->
            with('services', $services)->
            with('insurances', $insurances)->
            with('prices', $prices)->
            with('count', $count);
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
        if(!empty($treatments)) {
        $treatmentsArray = array_filter($treatments);
        } else {
            $treatmentsArray = 0;
        }
        if(!empty($investigations)) {
        $investigationsArray = array_filter($investigations);
        } else {
            $investigationsArray = 0;
        }

        if (!empty($servicesArray)) {
        foreach ($services as $service => $n)
            {
                $transaction = New Patient_transaction;
                $transaction->patient_id = $patient->id;
                $transaction->type = 'service';
                $transaction->type_id = $servicesArray[$service];
                if ($insurance->name == 'Cash')
                    {
                        $price = Service::where('id', $servicesArray[$service])->
                            get()->first();
                        $price = $price->cash;
                    }
                else
                    {
                        $price = Service::where('id', $servicesArray[$service])->
                            get()->first();
                        $price = $price->insurance;
                    }
                $transaction->type_price = $price;
                $transaction->user = Auth::user()->name;
                $transaction->save();
            }
        }

        if (!empty($treatmentsArray)) {
        foreach ($treatments as $treatment => $n)
            {
                $transaction = New Patient_transaction;
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
        }

        if (!empty($investigationsArray)) {
        foreach ($investigations as $investigation => $n)
            {
                $transaction = New Patient_transaction;
                $transaction->patient_id = $patient->id;
                $transaction->type = 'investigation';
                $transaction->type_id = $investigationsArray[$investigation];
                $price = Investigation::where('id', $investigationsArray[$investigation])->
                    get()->first();
                $price = $price->price;
                $transaction->type_price = $price;
                $transaction->user = Auth::user()->name;
                $transaction->save();
            }
        }
        #Enter a new payment record in the patient_payments table for the amount paid
        #Start by checking if a payment was made in full or just part of it
        $patient_payment = New Patient_payment;
        if (count($request->paidamount)>0)
            {
                $payment = $request->paidamount;
            }
        else
            {
                $payment = $request->payment;
            }
        
        $patient_payment->patient_id = $patient->id;
        $patient_payment->paid = $payment;
        $patient_payment->status = 1;
        $patient_payment->user = Auth::user()->name;
        $patient_payment->save(); #Enter whatever amount was paid as a payment in the table

        #Update the status in patients table to 0 so that they dont show up in services.show
        $patient = Patient::find($patient)->first();
        $patient->status = 0;
        $patient->save();
        return $this->create();
    }

    public function credit(Patient $patient)
    {
        $services = Service::All('name', 'id');
        $patient = Patient::find($patient)->first();
        $patient_id = $patient->id;
        $count = Patient::where('status', 1)->count();
        $servs = $patient->services()->where('patient_id', $patient_id)->wherePivot('status', '=', 0)->get();
        $treatments = $patient->treatments()->where('patient_id', $patient_id)->wherePivot('status', '=', 0)->get();
        $investigations = $patient->investigations()->where('patient_id', $patient_id)->wherePivot('status', '=', 0)->get();
        $insurances = $patient->insurances()->where('patient_id', $patient_id)->get()->first();
        if ($insurances->name == 'Cash') {
            $sprice = $patient->services()->where('patient_id', $patient->id)->wherePivot('status', '=', 0)->sum('cash');
                }
        else {
            $sprice = $patient->services()->where('patient_id', $patient->id)->wherePivot('status', '=', 0)->sum('insurance');
            }
        $prices = array(
            'iprice' =>$patient->investigations()->where('patient_id', $patient_id)->wherePivot('status', '=', 0)->sum('price'), 
            'tprice' =>$patient->treatments()->where('patient_id', $patient_id)->wherePivot('status', '=', 0)->sum('treatment_payment'),
            'sprice' =>$sprice
            );

        #Return the page that lists the summary of credit incurred
        return view('patients/credit')->
            with('patient', $patient)->
            with('services', $services)->
            with('insurances', $insurances)->
            with('prices', $prices)->
            with('count', $count);
        return $investigations;
    }

    public function paycredit(Request $request)
    {
        // The validation of the form
        $this->validate($request, [
        'credit' => 'integer|required',
        ]);

        # Add payments for patient
        $payment = new Patient_payment;
        $payment->patient_id = $request->patient;
        $payment->paid = $request->credit;
        $payment->status = 0;
        $payment->user = Auth::user()->name;
        $payment->save();

        $patients = Patient::where('status', 0)->with('district')->with('services')->with('transactions')->get();
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        return view('reports/full')->
            with('services', $services)->
            with('count', $count)->
            with('patients', $patients);
    }
}