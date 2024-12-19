<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\TAdminCountry;
use App\Models\Admin\TAdminState;
use App\Models\Admin\TAdminCity;
use App\Models\Admin\TCreedTags;
use App\Models\Admin\TAboutUs;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\Admin\TDays;
use App\Models\Api\TBusinessGallery;
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

    // Business info store step 1
    public function businessInfoStore1(Request $request)
    {
   
        try{
            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->get()->pluck('id')->first();
           
            $businessData = New TBusiness();
            $businessData->business_owner_id = $businessOwnerId;
            $businessData->business_name = $request->business_name;
            $businessData->business_type_id = json_encode($request->business_type_id);
            $businessData->business_category_id = $request->business_category_id;
            $businessData->business_subcategory_id = $request->business_subcategory_id;
            $businessData->address = $request->address;
            $businessData->lat = $request->lat;
            $businessData->long = $request->long;
            $businessData->country = $request->country;
            $businessData->state = $request->state;
            $businessData->city = $request->city;
            $businessData->zip_code = $request->zip_code;
            $businessData->business_email = $request->business_email;
            $businessData->business_phone_number = $request->business_phone_number;
            $businessData->business_website = $request->business_website;
            $businessData->affiliation_id = json_encode($request->affiliation_id);
            $businessData->status = 2;
            $businessData->save();
            // return $businessData;
            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId);
            $tUserBusinessOwnerInfo->business_id = $businessData->id;
            $tUserBusinessOwnerInfo->status = 2;
            $tUserBusinessOwnerInfo->save();
        
            $tUsers = User::find($tUserBusinessOwnerInfo->user_id);
            $tUsers->account_type = 'GB';
            $tUsers->save();

            $message = "Business information step 1 successfully saved.";
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'userBusinessInfo' => $businessData->makeHidden(['created_at','updated_at']),
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

    // Business info store step 2
    public function businessInfoStore2(Request $request)
    {
        try{
            
            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->where('status', 2)->get()->first();
            
            if(empty($businessOwnerId->id)){
                $message = "Please first fillup Business information step 1.";
                return response()->json([
                    'status' => 'failed',
                    'message' => $message
                ],500);
            }
           
            if ($request->hasFile('business_profile_image')) {
                $file = $request->file('business_profile_image');
                $profile = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/profile'), $profile);
                $imagePath = 'images/business/profile/' . $profile;
            }else{
                $profile = '';
            }

            $businessData = TBusiness::find($businessOwnerId->business_id);
            $businessData->description = $request->description;
            $businessData->business_profile_image = $profile;
            $businessData->service_area = json_encode($request->service_area);
            $businessData->customer_hotline = $request->customer_hotline;
            $businessData->customer_email_leads = $request->customer_email_leads;
            $businessData->status = 3;
            $businessData->save();
            
            if($request->business_profile_image!='null'){
                foreach($request->business_profile_image as $value){
                    if ($request->hasFile($value)) {
                        $file = $request->file($value);
                        $gallery = time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('images/business/gallery'), $gallery);
                        $imagePath = 'images/business/gallery/' . $gallery;
                    }else{
                        $gallery = '';
                    }

                    $galleryData = new TBusinessGallery();
                    $galleryData->business_id = $businessData->id;
                    $galleryData->business_galley_image = $gallery;
                    $galleryData->save();
                }
            }
            // return $request->all();
            foreach($request->operation_data as $value){
                
                $operationDatas = new TOperationHour();
                $operationDatas->business_id = $businessData->id;
                $operationDatas->day = $value['day'];
                $operationDatas->open_time = $value['open_time'];
                $operationDatas->closed_time = $value['closed_time']; 
                $operationDatas->save();
            }
            
            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
            $tUserBusinessOwnerInfo->status = 3;
            $tUserBusinessOwnerInfo->save();
          
            $message = "Business information step 2 successfully saved.";
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'userBusinessInfo' => $businessData->makeHidden(['created_at','updated_at']),
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

    // Business info store step 3
    public function businessInfoStore3(Request $request)
    {
   
        try{

            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->where('status', 3)->get()->first();
           
            if(empty($businessOwnerId->id)){
                $message = "Please first fillup Business information step 2.";
                return response()->json([
                    'status' => 'failed',
                    'message' => $message
                ],500);
            }
           
            if ($request->hasFile('halal_certificate')) {
                $file = $request->file('halal_certificate');
                $halal_certificate = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/halal_certificate'), $halal_certificate);
                $imagePath = 'images/business/halal_certificate/' . $halal_certificate;
            }else{
                $halal_certificate = '';
            }

            if ($request->hasFile('handcut_certificate')) {
                $file = $request->file('handcut_certificate');
                $handcut_certificate = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/handcut_certificate'), $halal_certificate);
                $imagePath = 'images/business/handcut_certificate/' . $handcut_certificate;
            }else{
                $handcut_certificate = '';
            }

            $businessData = TBusiness::find($businessOwnerId->business_id);
            $businessData->creed_tags_id = json_encode($request->creed_tags_id);
            $businessData->restaurant_id = json_encode($request->restaurant_id);
            $businessData->halal_certificate = $halal_certificate;
            $businessData->handcut_text = $request->handcut_text;
            $businessData->handcut_certificate = $handcut_certificate;
            $businessData->status = 4;
            $businessData->save();
            
            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
            $tUserBusinessOwnerInfo->status = 4;
            $tUserBusinessOwnerInfo->save();

            $message = "Business information step 3 successfully saved.";
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'userBusinessInfo' => $businessData->makeHidden(['created_at','updated_at']),
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

    // Business info store step 4
    public function businessInfoStore4(Request $request)
    {
   
        try{

            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->where('status', 4)->get()->first();
            
            if(empty($businessOwnerId->id)){
                $message = "Please first fillup Business information step 3.";
                return response()->json([
                    'status' => 'failed',
                    'message' => $message
                ],500);
            }

            $businessData = TBusiness::find($businessOwnerId->business_id);
            $businessData->discount_code_description = $request->discount_code_description;
            $businessData->discount_code = $request->discount_code;
            $businessData->status = 5;
            $businessData->save();
            
            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
            $tUserBusinessOwnerInfo->status = 5;
            $tUserBusinessOwnerInfo->save();

            $message = "Business information step 4 successfully saved.";
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'userBusinessInfo' => $businessData->makeHidden(['created_at','updated_at']),
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

    // checkout-page
    // public function checkout(){}

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
        $radius = 0.1; // Radius in kilometers (100 meters = 0.1 kilometers)

        if ($perm == 0) {
            $latitude = '41.850033';         //'40.12150192260742';
            $longitude = '-87.6500523';      //'-100.45039367675781';
            $data = TBusiness::select(
                'id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'zip_code',
                'lat',
                'long',
                'business_phone_number',
                'business_email',
                'business_website',
                'affiliation_id',
                // DB::raw('`long` AS longitude'),
                DB::raw("(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(`long`) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat)))) AS distance")
            )
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            
            ->get()->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id']);

            $data = $data->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->businessCreedeName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->country->name ?? '';
                $business->state_name = $business->state->name ?? '';
                $business->city_name = $business->city->name ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
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
            'business_profile_image',
            'business_type_id',
            'business_category_id',
            'business_subcategory_id',
            'creed_tags_id',
            'address',
            'zip_code',
            'lat',
            'long',
            'business_phone_number',
            'business_email',
            'business_website',
            'affiliation_id',
            // DB::raw('`long` AS longitude'),
            DB::raw("(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(`long`) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat)))) AS distance")
        )
        ->having('distance', '<=', $radius)
        ->orderBy('distance', 'asc')
        ->get()->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id']);

            $data = $data->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->businessCreedeName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->country->name ?? '';
                $business->state_name = $business->state->name ?? '';
                $business->city_name = $business->city->name ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
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
        $multiBusinesses = TBusiness::select(
                'id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'zip_code',
                'lat',
                'long',
                'business_phone_number',
                'business_email',
                'business_website',
                'affiliation_id',
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
            ->get()->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id']);

            $multiBusinesses = $multiBusinesses->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->businessCreedeName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->country->name ?? '';
                $business->state_name = $business->state->name ?? '';
                $business->city_name = $business->city->name ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->country);
                unset($business->state);
                unset($business->city);
                return $business;
            });

        return response()->json(['success' => true, 'data' => $multiBusinesses]);
    }

    public function getBusinessProfile(Request $request){

        $business_profile = TBusiness::select(['id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'zip_code',
                'lat',
                'long',
                'service_area',
                'business_phone_number',
                'business_email',
                'business_website',
                'affiliation_id',
                'customer_hotline',
                'customer_email_leads',
                'description',
                'restaurant_id',
                'halal_certificate',
                'handcut_text',
                'handcut_certificate',
                'discount_code_description',
                'discount_code',
                'status'
                ])
                
                ->with('businessOwnerInfos')->where('id', $request->id)
                ->get()->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id']);

                $business_profile = $business_profile->map(function ($business) {

                    $business->business_type_name = $business->businessTypeName ?? '';
                    $business->business_category_name = $business->businessCategory->name ?? '';
                    $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                    $business->business_creed_name = $business->businessCreedeName ?? '';
                    $business->affiliation_name = $business->affiliationName ?? '';
                    $business->country_name = $business->country->name ?? '';
                    $business->state_name = $business->state->name ?? '';
                    $business->city_name = $business->city->name ?? '';
                    
                    unset($business->businessCategory);
                    unset($business->businessSubCategory);
                    unset($business->country);
                    unset($business->state);
                    unset($business->city);
                    return $business;
                });

        return response()->json([$business_profile]);
    }

    // All User List
    public function userList(){

        $data = User::get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    // Subscription plan list
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
        $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'lat',
                DB::raw('`long` AS longitude'),
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
    
    // Business Filter using Business Name
    public function searchByBusinessName(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
            'business_name' => 'required|string',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
        $business_name = $validated['business_name'];
        $radius = 0.1; 
        // Convert degrees to radians for calculations
        $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'lat',
                DB::raw('`long` AS longitude'),
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
            ->where('business_name', $business_name)
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

    // Business Filter using Business Category,SubCategory text
    public function searchByBusinessCatSubCategory(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
            'catSubCat' => 'required|string',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
        $catSubCat = $validated['catSubCat'];
        $radius = 0.1; 
        // Convert degrees to radians for calculations
        $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'lat',
                DB::raw('`long` AS longitude'),
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
    
            ->whereHas('businessCategory', function($query) use ($catSubCat) {
                $query->where('name', $catSubCat);})
            ->orWhereHas('businessSubCategory', function($query) use ($catSubCat) {
                $query->where('name', $catSubCat);})
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

    // search box
    public function searchBox(){
        
        $businessName = TBusiness::select('id','business_name')->get(); 
        // $businessCatSUbCat =TBusinessCategory::with('subcategories:id,name,category_id')->select(['id','name'])->where('status', 1)->get(); 
        $category = TBusinessCategory::select('id','name')->where('status', 1)->get(); 
        $subcategory = TBusinessSubcategory::select('id','name','category_id')->where('status', 1)->get(); 
        $data['category'] = $category;
        $data['subcategory'] = $subcategory;
        $data['businessName'] = $businessName;

        return response()->json(['success' => true, 'data' => $data]);
    }

    // get category relations
    public function getCategoryRelation(){
        
        $data = TBusinessCategory::with(['businesses','subcategories'])->get();

        return response()->json(['success' => true, 'data' => $data]);
    }

    // get subcategory relations
    public function getSubCategoryRelation(){
        
        $data = TBusinessSubCategory::with(['businesses','category'])->get();

        return response()->json(['success' => true, 'data' => $data]);
    }

    // aboutUs
    public function aboutUs(){

        $data = TAboutUs::get()->makeHidden(['status','created_by','updated_by','created_at','updated_at']);
        return response()->json(['success' => true, 'data' => $data]);
    }

    // search with search box
    public function searchBySearchBox(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
            'catSubCat' => 'nullable|string',
            'business_name' => 'nullable|string',
        ]);

        if($request->business_name!=null){

            $latitude = $validated['lat'];
            $longitude = $validated['long'];
            $business_name = $validated['business_name'];
            $radius = 0.1; 
            // Convert degrees to radians for calculations
            $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                    'id',
                    'business_name',
                    'business_type_id',
                    'business_category_id',
                    'business_subcategory_id',
                    'creed_tags_id',
                    'lat',
                    DB::raw('`long` AS longitude'),
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
                ->where('business_name', $business_name)
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
        }else{

            $latitude = $validated['lat'];
            $longitude = $validated['long'];
            $catSubCat = $validated['catSubCat'];
            $radius = 0.1; 
            // Convert degrees to radians for calculations
            $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','country:id,name','state:id,name','city:id,name'])->select(
                    'id',
                    'business_name',
                    'business_type_id',
                    'business_category_id',
                    'business_subcategory_id',
                    'creed_tags_id',
                    'lat',
                    DB::raw('`long` AS longitude'),
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
        
                ->whereHas('businessCategory', function($query) use ($catSubCat) {
                    $query->where('name', $catSubCat);})
                ->orWhereHas('businessSubCategory', function($query) use ($catSubCat) {
                    $query->where('name', $catSubCat);})
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
}
