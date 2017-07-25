<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Service;
use App\Http\Models\Patient;
use App\Http\Models\Patient_payment;
use App\Http\Models\Patient_transaction;

class ReportController extends Controller
{
    // Calling the constructor middleware for auth
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$services = Service::all();
        $count = Patient::where('status', 1)->get();
        $transactions = Patient_transaction::whereYear('created_at', date('Y'))->
	        whereMonth('created_at', date('m'))->
	        sum('type_price');
        $payments = Patient_payment::whereYear('created_at', date('Y'))->
	        whereMonth('created_at', date('m'))->
	        sum('paid');
        $statistics = array(
	        'male' => Patient::where('sex', 'male')->
	        	whereMonth('created_at', date('m'))->
	        	distinct()->
	        	count('uid'),
	        'female' => Patient::where('sex', 'female')->
	        	whereMonth('created_at', date('m'))->
	        	distinct()->
	        	count('uid'),
	        'revenue' => Patient_payment::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	sum('paid'),
	        'lastmonth' => Patient_payment::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', (date('n')-1))->
	        	sum('paid'),
        	'creditors' => $transactions - $payments,
	        'investigations' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	where('type', 'investigation')->
	        	sum('type_price'),
	        'todayinvestigations' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	whereDay('created_at', date('d'))->
	        	where('type', 'investigation')->
	        	sum('type_price'),
	        'treatments' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	where('type', 'treatment')->
	        	sum('type_price'),
	        'todaytreatments' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	whereDay('created_at', date('d'))->
	        	where('type', 'treatment')->
	        	sum('type_price'),
	        'registrations' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	where('type', 'service')->
	        	sum('type_price'),
	        'todayregistrations' => Patient_transaction::whereYear('created_at', date('Y'))->
	        	whereMonth('created_at', date('m'))->
	        	whereDay('created_at', date('d'))->
	        	where('type', 'service')->
	        	sum('type_price')
	    	);
        return view('reports/index')->
        	with('services', $services)->
        	with('count', $count)->
        	with('statistics', $statistics);
        // return $daterange;
    }
}
