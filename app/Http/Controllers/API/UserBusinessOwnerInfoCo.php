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
            $businessData->business_type_id = $request->business_type_id;
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

    // Business info store step 1
    public function businessInfoStore2(Request $request)
    {
   
        try{
            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->get()->pluck('id')->first();
           
            if ($request->hasFile('business_profile_image')) {
                $file = $request->file('business_profile_image');
                $profile = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/profile'), $profile);
                $imagePath = 'images/business/profile/' . $profile;
            }else{
                $profile = '';
            }

            $businessData = New TBusiness();
            $businessData->description = $request->description;
            $businessData->business_profile_image = $profile;
            $businessData->service_area = json_encode($request->service_area);
            $businessData->customer_hotline = $request->customer_hotline;
            $businessData->customer_email_leads = $request->customer_email_leads;
            $businessData->status = 3;
            $businessData->save();

            if($request->business_profile_image!='null'){
                foreach($request->business_profile_image as $value){
                    if ($request->hasFile('business_gallery_image')) {
                        $file = $request->file('business_gallery_image');
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

            foreach($request->operationData as $value){

                $operationDatas = new TOperationHour();
                $operationDatas->business_id = $businessData->id;
                $operationDatas->day = $value['day'];
                $operationDatas->open_time = $value['open_time'];
                $operationDatas->closed_time = $value['closed_time'];
                $operationDatas->save();
            }
            
            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId);
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

    // public function businessInfoStore(Request $request)
    // {
   
    //     // $validator = $request->validated();
    //     try{
            
    //         $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->get()->pluck('id')->first();
            
    //         $input = $request->all();

    //         if ($request->hasFile('business_profile_image')) {
    //             $file = $request->file('business_profile_image');
    //             $profile = time() . '.' . $file->getClientOriginalExtension();
    //             $file->move(public_path('images/business/profile'), $profile);
    //             $imagePath = 'images/business/profile/' . $profile;
    //         }else{
    //             $profile = '';
    //         }

    //         // $input['business_owner_id'] = $businessOwnerId;
    //         // if ($request->hasFile('halal_certificate')) {
    //         //     $file = $request->file('halal_certificate');
    //         //     $fileName = time() . '.' . $file->getClientOriginalExtension();
    //         //     $file->move(public_path('images/restaurant/halalCertificate'), $fileName);
    //         //     $imagePath = 'images/restaurant/halalCertificate/' . $fileName;
    //         // }
    //         // if ($request->hasFile('handcut_certificate')) {
    //         //     $file = $request->file('handcut_certificate');
    //         //     $fileName2 = time() . '.' . $file->getClientOriginalExtension();
    //         //     $file->move(public_path('images/restaurant/handcutCertificate'), $fileName2);
    //         //     $imagePath = 'images/restaurant/handcutCertificate/' . $fileName2;
    //         // }
    //         // $tUserBusinessInfo['halal_certificate'] = $fileName;
    //         // $tUserBusinessInfo['handcut_certificate'] = $fileName2;

    //         $input['creed_tags_id'] = json_encode($request->creed_tags_id);
    //         $input['business_profile_image'] = $profile;
    //         $input['affiliation_id'] = json_encode($request->affiliation_id);
    //         // $tUserBusinessInfo = TBusiness::create($input);
    //         if($request->business_profile_image!='null'){

    //             if ($request->hasFile('business_gallery_image')) {
    //                 $file = $request->file('business_gallery_image');
    //                 $gallery = time() . '.' . $file->getClientOriginalExtension();
    //                 $file->move(public_path('images/business/gallery'), $gallery);
    //                 $imagePath = 'images/business/gallery/' . $gallery;
    //             }else{
    //                 $gallery = '';
    //             }

    //             $galleryData = new TBusinessGallery();
    //             $galleryData->business_id = 1; //$tUserBusinessInfo->id
    //             $galleryData->business_galley_image = $gallery;
    //             $galleryData->save();
    //         }
    //         return $input;
            

    //         $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($request->business_owner_id);
    //         $tUserBusinessOwnerInfo->business_id = $tUserBusinessInfo->id;
    //         $tUserBusinessOwnerInfo->save();

    //         $tUsers = User::find($tUserBusinessOwnerInfo->user_id);
    //         $tUsers->account_type = 'GB';
    //         $tUsers->save();

    //         return response()->json([
    //             'status' => 'success',
    //             'userBusinessInfo' => $tUserBusinessInfo->makeHidden(['created_at','updated_at']),
    //             'userBusinessOwnerInfo' => $tUserBusinessOwnerInfo->makeHidden(['created_at','updated_at'])
    //         ],200);

    //     } catch (QueryException $e) {
    //         $errorMessage = "Database error: Unable to submit data.!";
    //         return response()->json([
    //             'status' => 'failed',
    //             'message' => $errorMessage,
    //         ],500);
    //         return redirect()->back()->with('error', '');
    //     } catch (\Exception $e) {
         
    //         return response()->json([
    //             'status' => 'failed',
    //             'errors' => $validator->errors(),
    //         ],422);
    //     }

    // }

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

        if ($perm == 0) {
            $latitude = '41.850033';         //'40.12150192260742';
            $longitude = '-87.6500523';      //'-100.45039367675781';
            $data = TBusiness::select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
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

        // Haversine formula to calculate distance between two points
        $data = TBusiness::select(
            'id',
            'business_name',
            'business_type_id',
            'business_category_id',
            'business_subcategory_id',
            'creed_tags_id',
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
