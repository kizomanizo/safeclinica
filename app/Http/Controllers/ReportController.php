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
	        	sum('type_price'),
	        'month' => date('M'),
	        'dailypatients' => DB::select("SELECT DATE_FORMAT(created_at, '%d') AS date, COUNT(patients.uid) AS patients FROM patients GROUP BY DAY(patients.created_at)"),
	        // 'dailypatients' => DB::select("SELECT DATE_FORMAT(created_at, '%d') AS date FROM patients")
	    );
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
					if($dt->daysInMonth == 31) {
						$daysinamonth = "1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31";
						}
					else if($dt->daysInMonth == 30) {
						$dayinamonth = "1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30";
						}
					else if($dt->daysInMonth == 29) {
						$daysinamonth = "1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29";
						}
					else {
						$daysinamonth = "1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28";
						}
			// return view('tests/index')->with('dailypatients', $dailypatients)->with('daysinamonth', $daysinamonth);
        return view('reports/index')->
        	with('services', $services)->
        	with('count', $count)->
        	with('statistics', $statistics)->
        	with('dailypatients', $dailypatients)->
        	with('daysinamonth', $daysinamonth);
    }
}
