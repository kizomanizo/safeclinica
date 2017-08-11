<?php

namespace App\Http\Controllers;
use App\Http\Models\File;

use App\Http\Models\User;
use App\Http\Models\Service;
use App\Http\Models\Patient;
use App\Http\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * [__construct auth]
     */
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
        $services = Service::All('id', 'name');
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        $roles = Role::all('id', 'name');
        $users = User::all();
        return view('users/index')->
                with('services', $services)->
                with('count', $count)->with('logo', $logo)->
                with('roles', $roles)->
                with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check if the loged in user ca access this method
        $request->user()->authorizeRoles(['administrator', 'manager']);
        // Load the form for adding users
        $services = Service::All('id', 'name');
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        $roles = Role::all('id', 'name');
        return view('users/create')->
                with('services', $services)->
                with('count', $count)->with('logo', $logo)->
                with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the loged in user ca access this method
        $request->user()->authorizeRoles('administrator');

        // Validating the creation form
        $this->validate($request, [
        'fullname' => 'required|max:255',
        'username' => 'required|unique:users|min:4',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required'
            ]);
        // The user is valid, store in database...
        $user_role = $request->role;
        $role = Role::where('id', $user_role)->first();
        $user = new User;
        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach($role);

        $services = Service::All('id', 'name');
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        $roles = Role::all('id', 'name');
        $users = User::all();
        return view('users/index')->
                with('services', $services)->
                with('count', $count)->with('logo', $logo)->
                with('roles', $roles)->
                with('users', $users);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Check if the loged in user ca access this method
        $request->user()->authorizeRoles('administrator');

        // Go ahead and destroy the user
        $user = User::destroy($user);
        $services = Service::All('id', 'name');
        $count = Patient::where('status', 1)->count();
        $logo = File::where('name', 'logo')->first();
        $roles = Role::all('id', 'name');
        $users = User::all();
        return view('users/index')->
                with('services', $services)->
                with('count', $count)->with('logo', $logo)->
                with('roles', $roles)->
                with('users', $users);
    }
}
