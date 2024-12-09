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
        $admin = User::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($request->password, $admin->password)){ 
        // if (Auth::attempt($credentials)) {
            $user = $admin; 
            // $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user->makeHidden('id'),
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
    
        $request->validated();

        try {
           
            $input = $request->only(['email', 'password']);
            $input['password'] = Hash::make($input['password']);
            
            $user = User::create($input);

            // Generate the token
            $token = $user->createToken('manual-auth-token')->plainTextToken;
            $user['token'] = $token;

            // Return the response with reduced data
            return response()->json([
                'status' => 'success',
                'message' => 'User successfully signup.',
                'user' => $user->makeHidden(['id','created_at','updated_at']),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'There were validation errors.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Signup failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Signup failed. Please try again later.'
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
                $user['token'] = $token;

                return response()->json([
                    'status' => 'success',
                    'user' => $user->makeHidden(['id','created_at','updated_at']),
                    // 'token' => $token,
                ]);

            }else{

                return response()->json([
                    'status' => 'success',
                    'user' => $users->makeHidden(['id','created_at','updated_at']),
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
