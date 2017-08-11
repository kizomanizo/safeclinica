<?php

namespace App\Http\Controllers;
use App\Http\Models\File;
use App\Http\Models\Insurance;
use App\Http\Models\Service;
use App\Http\Models\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function welcome()
    {
        return redirect()->route('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */    public function index()
    {
        return view('static/home');
    }

    public function settings()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        return view('static/settings')->
            with('services', $services)->
            with('count', $count)->with('logo', $logo);
    }

    public function reports()
    {
        $services = Service::all();
        $count = Patient::where('status', 1)->count();
    $logo = File::where('name', 'logo')->first();
        return view('reports')->
            with('services', $services)->
            with('count', $count)->with('logo', $logo);
    }

    public function logo(Request $request)
    {
        // Validate the logo if it is an image and if it fits the size
        $this->validate($request, [
            'logo' => 'required|image|dimensions:max=600,max_height=200',
        ]);
        $name = 'logo';
        $oldname = $request->file('logo')->getClientOriginalName();
        //$newname = $request->file('logo')->store('public');
        $file = $request->file('logo');
        $filename = time(). '-' . $oldname;
        $file = $file->move(public_path().'/uploads/', $filename);

        // Send the file location and old name to the DB
        if (count(File::where('name', 'logo')->first()) > 0) {
        $logo = File::where('name', 'logo')->first();
        $file = File::destroy($logo->id);
        $file = unlink(public_path($logo->newname));
        }
        $file = new File;
        $file->name = 'logo';
        $file->oldname = $oldname;
        $file->newname = 'uploads/'.$filename;
        $file->user = Auth::user()->name;
        $file->save();

        // Load patients create page
        return redirect('patients/create');
    }
}
