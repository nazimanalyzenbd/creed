<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\User;
use App\Http\Requests\Api\TBusinessOwnerInfoRequest;
use App\Http\Requests\Api\TBusinessRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Auth;

class UserBusinessOwnerInfoCo extends Controller
{

    public function businessOwnerInfoStore(TBusinessOwnerInfoRequest $request)
    {
       
        $validator = $request->validated();
        try{
            
            $input = $request->all();
            $input['user_id'] = $request->user()->id;
            $tUserTBusinessOwnerInfo = TBusinessOwnerInfo::create($input);

            return response()->json([
                'status' => 'success',
                'data' => $data->makeHidden('id')
            ],200);

        } catch (QueryException $e) {
            $errorMessage = "Database error: Unable to submit data.!";
            return response()->json([
                'status' => 'failed',
                'message' => $errorMessage,
            ],500);
            return redirect()->back()->with('error', '');
        } catch (\Exception $e) {
         
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ],422);
        }

    }

    public function businessInfoStore(TBusinessRequest $request)
    {
       
        $validator = $request->validated();
        try{
            
            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->get()->pluck('id')->first();
            
            $input = $request->all();
            $input['business_owner_id'] = $businessOwnerId;
            $tUserBusinessInfo = TBusiness::create($input);

            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId);
            $tUserBusinessOwnerInfo->business_id = $tUserBusinessInfo->id;
            $tUserBusinessOwnerInfo->save();

            return response()->json([
                'status' => 'success',
                'tUserBusinessOwnerInfo' => $tUserBusinessOwnerInfo->makeHidden('id')
            ],200);

        } catch (QueryException $e) {
            $errorMessage = "Database error: Unable to submit data.!";
            return response()->json([
                'status' => 'failed',
                'message' => $errorMessage,
            ],500);
            return redirect()->back()->with('error', '');
        } catch (\Exception $e) {
         
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ],422);
        }

    }

}
