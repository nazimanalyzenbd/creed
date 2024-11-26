<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\TAdminUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.registr');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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

        event(new Registered($tAdminUser));

        Auth::login($tAdminUser);

        return redirect(route('dashboard', absolute: false));
    }
}
