<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\TAdminCountry;
use App\Models\Admin\TAdminState;
use App\Models\Admin\TAdminCity;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\Admin\TBusinessTags;
use App\Models\Admin\TBusinessType;
use App\Models\Admin\TBusinessCategory;
use App\Models\Admin\TBusinessSubCategory;
use App\Http\Requests\Api\TBusinessOwnerInfoRequest;
use App\Http\Requests\Api\TBusinessRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Auth;
use DB;

class UserBusinessOwnerInfoCo extends Controller
{

    public function businessOwnerInfoStore(TBusinessOwnerInfoRequest $request)
    {
        // return response()->json($request->user()->id);
       
        $validator = $request->validated();
        try{
            
            $input = $request->all();
            $input['user_id'] = '1';
            $tUserTBusinessOwnerInfo = TBusinessOwnerInfo::create($input);

            return response()->json([
                'status' => 'success',
                'tUserTBusinessOwnerInfo' => $tUserTBusinessOwnerInfo->makeHidden('id')
            ],200);

        } catch (QueryException $e) {
            $errorMessage = "Database error: Unable to submit data.!";
            return response()->json([
                'status' => 'failed',
                'message' => $errorMessage,
            ],500);
            
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

    public function businessType(){

        $data = TBusinessType::where('status', 1)->get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessCategory(){

        $data = TBusinessCategory::where('status', 1)->get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessSubCategory(){

        $data = TBusinessSubCategory::where('status', 1)->get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessTags(){

        $data = TBusinessTags::where('status', 1)->get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function countryList(){

        $data = TAdminCountry::get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function stateList(){

        $data = TAdminState::get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function cityList(){

        $data = TAdminCity::get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

}
