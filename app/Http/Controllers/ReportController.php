<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Service;
use App\Http\Models\Patient;

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
        $male = Patient::where('sex', 'male')->count('id');
        $female = 1;
        $malefemale = 2;
        return $male;
        // return view('reports/index')->with('services', $services)->with('count', $count)->with('male', $male);
    }
}
