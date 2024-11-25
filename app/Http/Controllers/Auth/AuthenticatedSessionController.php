<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin\TAdminUser;
use Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();
        $admin = TAdminUser::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            // dd('hi');
            Auth::guard('web')->login($admin);

            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Failed login attempt
        return back()->withErrors(['email' => 'These credentials do not match our records.']);

        // $request->session()->regenerate();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
