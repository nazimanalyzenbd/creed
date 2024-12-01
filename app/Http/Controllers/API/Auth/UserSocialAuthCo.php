<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
// use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\AppleProvider;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\Auth\UserRequest;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Sanctum\Sanctum;
use Auth;
use Hash;

class UserSocialAuthCo extends Controller
{
    /**
     * Redirect to Google authentication.
     *
     * @return \Illuminate\Http\Response
     */

    public function manualLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
       
        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }
    }

    public function manualsignUp(UserRequest $request)
    {
        $validator = $request->validated();

        try {    
            $input = $request->all();
            $input['name'] = $request->first_name .' '. $request->last_name;
            $input['password'] = Hash::make($input['password']);
            $users = User::create($input);

            // Generate a token for API access
            $token = $users->createToken('manual-auth-token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'user' => $users->makeHidden('id'),
                'token' => $token,
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

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

                $user = new User();
                $user->google_id = $googleUser->getId();
                $user->name = $googleUser->getName();
                $user->first_name = $googleUser->user['given_name'];
                $user->last_name = $googleUser->user['family_name'];
                $user->email = $googleUser->getEmail();
                $user->avatar = $googleUser->getAvatar();
                $user->save();

                // Generate a token for API access
                $token = $user->createToken('google-auth-token')->plainTextToken;

                return response()->json([
                    'status' => 'success',
                    'user' => $user->makeHidden('id'),
                    'token' => $token,
                ]);

            }else{

                return response()->json([
                    'status' => 'success',
                    'user' => $users->makeHidden('id'),
                ]);
            }
            
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate with Google.',
                'error' => $e->getMessage(),
            ], 500);
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

            $appleUser = Socialite::driver('apple')->stateless()->user();
            $users = User::where('google_id', $googleUser->getId())->first();
            
            if(!$users){
                $user = User::firstOrCreate([
                    'apple_id' => $appleUser->getId(),
                ], [
                    'name' => $appleUser->getName(),
                    'first_name' => $googleUser->user['given_name'],
                    'last_name' => $googleUser->user['family_name'],
                    'email' => $appleUser->getEmail(),
                ]);

                $token = $user->createToken('google-auth-token')->plainTextToken;
                
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'token' => $token,
                ]);

            }else{

                return response()->json([
                    'status' => 'success',
                    'user' => $users,
                ]);
            }
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate with Apple.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
