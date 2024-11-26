<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
// use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\AppleProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google authentication.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google authentication callback.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(Request $request)
    { 

        try {

            $googleUser = Socialite::driver('google')->stateless()->user();
            $users = User::where('google_id', $googleUser->getId())->first();

            if(!$users){

                $user = User::firstOrCreate([
                    'google_id' => $googleUser->getId(),
                ], [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                ]);

                // Generate a token for API access
                $token = $user->createToken('API Token')->plainTextToken;
                
                // Auth::login($user);
                // return redirect()->intended('dashboard');

                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'token' => $token,
                ]);

            }else{
                
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate with Google'], 500);
        }
    }

    /**
     * Redirect to Apple authentication.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * Handle Apple authentication callback.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();
            $user = User::firstOrCreate([
                'apple_id' => $appleUser->getId(),
            ], [
                'name' => $appleUser->getName(),
                'email' => $appleUser->getEmail(),
                // Add any other user data you want to store
            ]);

            // Create a JWT or session for the user and return it (if using API)
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate with Apple'], 500);
        }
    }
}
