<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Models\Service;
use App\Http\Models\Patient;
use App\Http\Models\Patient_payment;
use App\Http\Models\Patient_transaction;

class ReportController extends Controller
{
    /**
     * Calling the constructor middleware for auth
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$services = Service::all();
        $count = Patient::where('status', 1)->count();
        $transactions = Patient_transaction::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('type_price');
        $payments = Patient_payment::whereYear('created_at', date('Y'))->
	        whereMonth('created_at', date('m'))->
	        sum('paid');
        $days = Carbon::createFromDate(date('Y'), date('m'));
        	$month = date('Y-m');
			$start = Carbon::parse($month)->startOfMonth();
			$end = Carbon::parse($month)->endOfMonth();

			$dates = [];
			while ($start->lte($end)) {
			     $dates[] = $start->copy()->format('d');
			     $start->addDay();
			}
					$year = date('Y');
					$month = date('m');
					# code...
					$dailypatients = [];
					foreach($dates as $date) {
		$dailypatients[] = Patient::whereYear('created_at', $year)->
			whereMonth('created_at', $month)->
			whereDay('created_at', $date)->
			count('uid');
			}
		$dt = Carbon::now();
			if($dt->daysInMonth == 31) { $daysinamonth = implode(', ', (range(1, 31, 1))); 	}
			else if($dt->daysInMonth == 30) { $daysinamonth = implode(', ', (range(1, 30, 1)));	}
			else if($dt->daysInMonth == 29) { $daysinamonth = implode(', ', (range(1, 29, 1)));	}
			else { $daysinamonth = implode(', ', (range(1, 28, 1))); }
        $statistics = array(
	        'male' => Patient::where('sex', 'male')->
	        	whereMonth('created_at', date('m'))->
	        	distinct()->
	        	count('uid'),
	        'female' => Patient::where('sex', 'female')->
	        	whereMonth('created_at', date('m'))->
	        	distinct()->
	        	count('uid'),
	        'infants' => Patient::where('age', '<', 6)->
		        whereMonth('created_at', date('m'))->
		        distinct()->
	        	count('uid'),
	        'children' => Patient::where('age', '<', 12)->
		        whereMonth('created_at', date('m'))->
		        distinct()->
	        	count('uid'),
	        'adults' => Patient::where('age', '<', 65)->
		        whereMonth('created_at', date('m'))->
		        distinct()->
	        	count('uid'),
	        'elderly' => Patient::where('age', '>=', 65)->
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
	        	sum('type_price'),
	        'month' => date('F'),
	        'dailypatients' => $dailypatients,
	        'daysinamonth' => $daysinamonth
	    );

			// print_r($daysinamonth);
        return view('reports/index')->
        	with('services', $services)->
        	with('count', $count)->
        	with('statistics', $statistics);
    }
	/**
	 * Pulls a page that shows detailed table about patients
	 * @return [view] [list all patients in a month]
	 */
    public function full()
    {
    	$patients = Patient::whereMonth('created_at', date('m'))->where('status', 0)->get();
    	$services = Service::all();
        $count = Patient::where('status', 1)->count();
        // return $patients;
        return view('reports/full')->
        	with('services', $services)->
        	with('count', $count)->
        	with('patients', $patients);

    }
}
