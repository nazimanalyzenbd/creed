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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
        $admin = User::select('id','email','password','account_type','name','first_name','last_name')->where('email', $credentials['email'])->first();

        if ($admin && Hash::check($request->password, $admin->password)){ 
        // if (Auth::attempt($credentials)) {
            $user = $admin; 
            // $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            $user['token'] = $token;

            $user = $user->toArray();
            array_walk_recursive($user, function (&$item) {
                $item = $item ?? '';
            });
            
            return response()->json([
                'success' => 'success',
                'message' => 'Signin Successful ',
                'user' => $user,
            ], 200);
        } else {
            
            return response()->json([
                'success' => 'failed',
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
                'message' => 'Signup successful.',
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

            $users = User::select('id','email','password','account_type','name','first_name','last_name')->where('google_id', $request->google_id)->first();
            
            if(!$users){
                $input = $request->all();
                $input['avatar'] = $request->photo;
                $user = User::create($input);

                // Generate a token for API access
                $token = $user->createToken('google-auth-token')->plainTextToken;
                $user['token'] = $token;
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Signup Successful.',
                    'user' => $user->makeHidden(['id','created_at','updated_at']),
                ]);

            }else{

                return response()->json([
                    'status' => 'success',
                    'user' => $users->makeHidden(['created_at','updated_at']),
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

    public function sendOtp(Request $request){
          
        $request->validate([
            'email' => 'required|email',        //|exists:users,email
        ]);

        $user = User::select('id','email','password','account_type','name','first_name','last_name')->where('email', $request['email'])->first();

        if ($user){ 
            
            $otp = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

            $user = User::where('email', $request->email)->first();
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(10); // OTP expires in 10 minutes
            $user->otp_status = 0;
            $user->save();
    
            // Send OTP to the user's email
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Your OTP for password reset');
            });

            $data['otp'] =$otp;
            $data['otp_expires_at'] = $user->otp_expires_at;
            $data['otp_status'] = $user->otp_status;
            
            return response()->json([
                'success' => 'success',
                'message' => 'OTP sent Successful ',
                'data' => $data,
            ], 200);
        } else {
            
            return response()->json([
                'success' => 'failed',
                'message' => 'Invalid email',
            ], 401);
        }
    }

    public function verifyOtp(Request $request){
          
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:5',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->otp === $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {

            $user->otp = null; 
            $user->otp_expires_at = null; 
            $user->otp_status = 1; 
            $user->save();
    
            return response()->json(['message' => 'OTP Matched Successful.'], 200);
        }
    
        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

    public function resetPassword(Request $request){
          
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);
    
            $user = User::where('email', $request->email)->first();
            if($user){
        
            $user->password = Hash::make($request->password);
            $user->save();
            
            return response()->json(['message' => 'Password has been successfully reset.'], 200);

        }else{
            return response()->json(['message' => 'Invalid Password or Email.'], 400);
        }
        
    }

}
