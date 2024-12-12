<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\TAdminCountry;
use App\Models\Admin\TAdminState;
use App\Models\Admin\TAdminCity;
use App\Models\Admin\TCreedTags;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\Admin\TDays;
use App\Models\Admin\TAdminAffiliation;
use App\Models\Admin\TAdminRestaurant;
use App\Models\Admin\TAdminSubscriptionPlan;
use App\Models\Api\TOperationHour;
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
        // return response()->json($request);
       
        $validator = $request->validated();
        try{
            
            $input = $request->all();
            $input['user_id'] = '1';
            $tUserTBusinessOwnerInfo = TBusinessOwnerInfo::create($input);

            return response()->json([
                'status' => 'success',
                'tUserTBusinessOwnerInfo' => $tUserTBusinessOwnerInfo
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
            // if ($request->hasFile('halal_certificate')) {
            //     $file = $request->file('halal_certificate');
            //     $fileName = time() . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('images/restaurant/halalCertificate'), $fileName);
            //     $imagePath = 'images/restaurant/halalCertificate/' . $fileName;
            // }
            // if ($request->hasFile('handcut_certificate')) {
            //     $file = $request->file('handcut_certificate');
            //     $fileName2 = time() . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('images/restaurant/handcutCertificate'), $fileName2);
            //     $imagePath = 'images/restaurant/handcutCertificate/' . $fileName2;
            // }
            // $tUserBusinessInfo['halal_certificate'] = $fileName;
            // $tUserBusinessInfo['handcut_certificate'] = $fileName2;

            $tUserBusinessInfo = TBusiness::create($input);

            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId);
            $tUserBusinessOwnerInfo->business_id = $tUserBusinessInfo->id;
            $tUserBusinessOwnerInfo->save();

            $tUsers = User::find($tUserBusinessOwnerInfo->user_id);
            $tUsers->account_type = 'GB';
            $tUsers->save();

            return response()->json([
                'status' => 'success',
                'userBusinessInfo' => $tUserBusinessInfo->makeHidden(['created_at','updated_at']),
                'userBusinessOwnerInfo' => $tUserBusinessOwnerInfo->makeHidden(['created_at','updated_at'])
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

        $data = TBusinessType::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);;

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessCategory(){

        $data = TBusinessCategory::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessSubCategory(){

        $data = TBusinessSubCategory::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessTags(){

        $data = TBusinessTags::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

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

    public function creedTags(){

        $data = TCreedTags::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function affiliationList(){

        $data = TAdminAffiliation::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function getNearByBusiness(Request $request){
        
        $latitude = $request->input('lat');
        $longitude = $request->input('long');
        $perm = $request->input('perm');
        $radius = 0.5; // Radius in kilometers (100 meters = 0.1 kilometers)

        if (!$latitude || !$longitude & $perm == 0) {
            $latitude = '40.12150192260742';
            $longitude = '-100.45039367675781';
            $data = TBusiness::select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'lat',
                DB::raw('`long` AS longitude'),
                DB::raw("(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(`long`) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat)))) AS distance")
            )
            // ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->get();

            $data = $data->map(function ($business) {

                $business->business_type_name = $business->businessType->name ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_tags_name = $business->businessTags->name ?? '';
                $business->creed_tags_name = $business->creedTags->name ?? '';
                $business->country_name = $business->country->name ?? '';
                $business->state_name = $business->state->name ?? '';
                $business->city_name = $business->city->name ?? '';
    
                unset($business->businessType);
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->businessTags);
                unset($business->creedTags);
                unset($business->country);
                unset($business->state);
                unset($business->city);
                return $business;
            });
    
            return response()->json(['status' => 'success', 'data' => $data], 200);
        }

        // Haversine formula to calculate distance between two points
        $data = TBusiness::select(
            'id',
            'business_name',
            'business_type_id',
            'business_category_id',
            'business_subcategory_id',
            'lat',
            DB::raw('`long` AS longitude'),
            DB::raw("(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(`long`) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat)))) AS distance")
        )
        ->having('distance', '<=', $radius)
        ->orderBy('distance', 'asc')
        ->get();

        $data = $data->map(function ($business) {

            $business->business_type_name = $business->businessType->name ?? '';
            $business->business_category_name = $business->businessCategory->name ?? '';
            $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
            $business->business_tags_name = $business->businessTags->name ?? '';
            $business->creed_tags_name = $business->creedTags->name ?? '';
            $business->country_name = $business->country->name ?? '';
            $business->state_name = $business->state->name ?? '';
            $business->city_name = $business->city->name ?? '';

            unset($business->businessType);
            unset($business->businessCategory);
            unset($business->businessSubCategory);
            unset($business->businessTags);
            unset($business->creedTags);
            unset($business->country);
            unset($business->state);
            unset($business->city);
            return $business;
        });

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function businessOperationHour(Request $request){

        // $validated = $request->validate([
        //     'business_id' => 'required|exists:businesses,id',
        //     'monday.open_time' => 'required|date_format:H:i',
        //     'monday.closed_time' => 'required|date_format:H:i',
        // ]);
    
        //$businessHours = [];
        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            if ($request->has($day)) {
                $businessHours[] = [
                    'business_id' => $request->business_id,
                    'day' => $day,
                    'open_time' => $request->input("{$day}.open_time"),
                    'closed_time' => $request->input("{$day}.closed_time"),
                ];
            }
        }
    
        // TOperationHour::insert($businessHours);
        return $businessHours;
    }

    public function daysList(){

        $data = TDays::where('status', 1)->get()->makeHidden(['created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function restaurantDataList(){

        $data = TAdminRestaurant::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function getMultiBusinessList(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
        $radius = 0.1; 
        // Convert degrees to radians for calculations
        $multiBusinesses = TBusiness::with('businessOwnerInfos')->select(
                '*',
                DB::raw("(
                    6371 * acos(
                        cos(radians($latitude)) *
                        cos(radians(lat)) *
                        cos(radians(`long`) - radians($longitude)) +
                        sin(radians($latitude)) *
                        sin(radians(lat))
                    )
                ) AS distance")
            )
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->get();

        return response()->json(['success' => true, 'data' => $multiBusinesses]);
    }

    public function getBusinessProfile(Request $request){

        $business_profile = TBusiness::with('businessOwnerInfos')->find($request->id);
        return response()->json([$business_profile]);
    }

    public function userList(){

        $data = User::get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function subscriptionPlanList(){

        $data = TAdminSubscriptionPlan::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    // Business Filter using Creed Tags
    public function searchByCreedTags(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
            'creed_id' => 'required',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
        $creed_id = $validated['creed_id'];
        $radius = 0.1; 
        // Convert degrees to radians for calculations
        $filterBusinesses = TBusiness::with(['businessOwnerInfos','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                '*',
                DB::raw("(
                    6371 * acos(
                        cos(radians($latitude)) *
                        cos(radians(lat)) *
                        cos(radians(`long`) - radians($longitude)) +
                        sin(radians($latitude)) *
                        sin(radians(lat))
                    )
                ) AS distance")
            )
            ->where('creed_tags_id', $creed_id)
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->get();

            $filterBusinesses = $filterBusinesses->map(function ($business) {

                $business->business_type_name = $business->businessType->name ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_tags_name = $business->businessTags->name ?? '';
                $business->creed_tags_name = $business->creedTags->name ?? '';
                $business->country_name = $business->country->name ?? '';
                $business->state_name = $business->state->name ?? '';
                $business->city_name = $business->city->name ?? '';

                unset($business->businessType);
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->businessTags);
                unset($business->creedTags);
                unset($business->country);
                unset($business->state);
                unset($business->city);
                return $business;
            });

        return response()->json(['success' => true, 'data' => $filterBusinesses]);
    }
    

}
