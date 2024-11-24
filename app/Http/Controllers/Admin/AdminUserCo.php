<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TAdminUser;

class AdminUserCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:191', 'unique:'.TAdminUser::class],
            'phone_number' => ['required', 'string', 'max:15', 'unique:'.TAdminUser::class],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'address'      => ['required', 'string'],
            'country'      => ['required', 'string', 'max:100'],
            'state'        => ['nullable', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:100'],
            'zip_code'     => ['required', 'string', 'max:100'],
        ]);

        $tAdminUser = TAdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,

        ]);

        return redirect()->route('dashboard')->with('success', 'Successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
