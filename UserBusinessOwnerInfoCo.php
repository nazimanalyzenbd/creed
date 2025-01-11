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
use App\Models\Admin\TAppTermsAndConditions;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\Admin\TDays;
use App\Models\Api\TBusinessRating;
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
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Auth;
use DB;

class UserBusinessOwnerInfoCo extends Controller
{
    // Business Owner info page
    public function businessOwnerInfoStore(TBusinessOwnerInfoRequest $request){

        $validator = $request->validated();
        
        try{
            if($request->owner_id=='null')
            {
                $input = $request->all();
                $tUserTBusinessOwnerInfo = new TBusinessOwnerInfo();
                $tUserTBusinessOwnerInfo->user_id = $request->user()->id;
                $tUserTBusinessOwnerInfo->first_name = $request->first_name;
                $tUserTBusinessOwnerInfo->last_name = $request->last_name;
                $tUserTBusinessOwnerInfo->email = $request->email;
                $tUserTBusinessOwnerInfo->country_code = $request->country_code;
                $tUserTBusinessOwnerInfo->phone_number = $request->phone_number;
                $tUserTBusinessOwnerInfo->address = $request->address;
                $tUserTBusinessOwnerInfo->save();

                $users = User::find($request->user()->id);
                if($users->name==''){
                    $users->name = $request->first_name .' '. $request->last_name;
                    $users->first_name = $request->first_name;
                    $users->last_name = $request->last_name;
                    $users->phone_number = $request->phone_number;
                    $users->address = $request->address;
                    $users->save();
                }
            }else{
                $tUserTBusinessOwnerInfo = TBusinessOwnerInfo::find($request->owner_id);
                $tUserTBusinessOwnerInfo->first_name = $request->first_name;
                $tUserTBusinessOwnerInfo->last_name = $request->last_name;
                $tUserTBusinessOwnerInfo->email = $request->email;
                $tUserTBusinessOwnerInfo->phone_number = $request->phone_number;
                $tUserTBusinessOwnerInfo->address = $request->address;
                $tUserTBusinessOwnerInfo->save();
            }
            return response()->json([
                'status' => 'success',
                'message'=> 'Owner info successfully saved.',
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
    public function businessInfoStore1(Request $request){

        $validator = Validator::make($request->all(), [
            
            'owner_id' => 'required',
            'business_name' => 'required|string',
            'business_type_id' => 'required',
            'business_category_id' => 'required',
            'address' => 'required|string',
            'lat' => 'required',
            'long' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'business_email' => 'required|email',
            'business_phone_number' => 'required',
            'business_subcategory_id' => 'nullable',
            'business_website' => 'nullable',
            'affiliation_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return withErrors($validator)->withInput();
        }
  
        try{

           $businessOwnerId = TBusinessOwnerInfo::where('id', $request->owner_id)->where('user_id', $request->user()->id)->where('status','>=',1)->get()->first();
           
           if(empty($businessOwnerId->id)){
               $message = "Please first fillup Business Owner information.";
               return response()->json([
                   'status' => 'failed',
                   'message' => $message
               ],500);
           }

            $array = $request->affiliation_id;
            $storedTexts = [];

            $array = array_map(function ($item) use (&$storedTexts) {
                if (!ctype_digit($item)) {
                    $storedTexts[] = $item; 
                    $newId = TAdminAffiliation::firstOrCreate(['name' => $item])->id;
                    return $newId; 
                }
                return ((string)$item);
            }, $array);

           if($businessOwnerId->business_id!=''){

                $businessData = TBusiness::find($businessOwnerId->business_id);
                $businessData->business_owner_id = $businessOwnerId->id;
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
                $businessData->country_code = $request->country_code;
                $businessData->business_phone_number = $request->business_phone_number;
                $businessData->business_website = $request->business_website;                
                $businessData->affiliation_id = json_encode($array);
                $businessData->status = 2;
                $businessData->save();
               
                $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
    	
	 }else{
          
                $businessData = New TBusiness();
                $businessData->business_owner_id = $businessOwnerId->id;
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
                $businessData->country_code = $request->country_code;
                $businessData->business_phone_number = $request->business_phone_number;
                $businessData->business_website = $request->business_website;
                $businessData->affiliation_id = json_encode($array);
                $businessData->status = 2;
                $businessData->save();
     
                $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
                $tUserBusinessOwnerInfo->business_id = $businessData->id;
                $tUserBusinessOwnerInfo->status = 2;
                $tUserBusinessOwnerInfo->save();
            
                $tUsers = User::find($tUserBusinessOwnerInfo->user_id);
                $tUsers->account_type = 'GB';
                $tUsers->save();
            }

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
                'errors' => $e->errors(),
            ],422);
        }

    }

    // Business info store step 2
    public function businessInfoStore2(Request $request){
 
       try{
            
            $businessOwnerId = TBusinessOwnerInfo::where('id', $request->owner_id)->where('user_id', $request->user()->id)->where('status','>=', 2)->get()->first();

            if(empty($businessOwnerId->id)){
                $message = "Please first fillup Business information step 1.";
                return response()->json([
                    'status' => 'failed',
                    'message' => $message
                ],500);
            }

            if ($request->file('business_profile_image')) {

                $file = $request->file('business_profile_image'); 
                $profile = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/profile'), $profile);
                $imagePath = 'images/business/profile/' .$profile;
            }

            $businessData = TBusiness::find($businessOwnerId->business_id);
            $businessData->description = $request->description;
            $businessData->business_profile_image = $imagePath;
            $businessData->service_area = json_encode($request->service_area);
            $businessData->hotline_country_code = $request->hotline_country_code;
            $businessData->customer_hotline = $request->customer_hotline;
            $businessData->customer_email_leads = $request->customer_email_leads;
            $businessData->status = 3;
            $businessData->save();
	
            $galleryCheck = TBusinessGallery::where('business_id', $businessData->id)->get();    
          
	 if(!empty($galleryCheck)){
            foreach($galleryCheck as $value){
                $galleryData = TBusinessGallery::find($value->id);
                $galleryData->delete();
            }}

       if ($request->hasFile('business_gallery_image')) {

                foreach ($request->file('business_gallery_image') as $image) {

                    $imageName = time().'_'.$image->getClientOriginalName();
                    $image->move(public_path('images/business/gallery'), $imageName);
                    $imagePaths = 'images/business/gallery/' . $imageName;

            
                 
                        $galleryData = new TBusinessGallery();
                    
                    $galleryData->business_id = $businessData->id;
                    $galleryData->business_gallery_image = $imagePaths;
                    $galleryData->save();
                }  
            }

            $operationHourCheck = TOperationHour::where('business_id', $businessData->id)->get();
            if(!empty($operationHourCheck)){
                foreach($operationHourCheck as $value){
                    $data =  ToperationHour::find($value->id);
                    $data->delete();
                }
            }	

            foreach ($request->operation_data as $scheduleData) {
              
                $scheduleData['business_id'] = $businessData->id;         
                TOperationHour::create($scheduleData);               
            }

            $tUserBusinessOwnerInfo = TBusinessOwnerInfo::find($businessOwnerId->id);
            $tUserBusinessOwnerInfo->status = 3;
            $tUserBusinessOwnerInfo->save();

	        $galleryDatas = TBusinessGallery::where('business_id',$businessData->id)->get()->makeHidden(['created_at','updated_at']);          
	        $operationHours = TOperationHour::where('business_id',$businessData->id)->get()->makeHidden(['created_at','updated-at']);
            
            $message = "Business information step 2 successfully saved.";
            
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'userBusinessInfo' => $businessData->makeHidden(['created_at','updated_at']),
                'userBusinessOwnerInfo' => $tUserBusinessOwnerInfo->makeHidden(['created_at','updated_at']),
                'galleryDatas' => $galleryDatas,
                'operationHours' => $operationHours,
            ],200);

       } catch (QueryException $e) {
           $errorMessage = "Database error: Unable to submit data.!";
           return response()->json([
               'status' => 'failed',
               'message' => $errorMessage,
           ],500);
           return redirect()->back()->with('error', '');
       } catch (\Throwable $e) {
         
           return response()->json([
               'status' => 'failed',
               'errors' => $e->errors(),
           ],422);
       }

    }

    // Business info store step 3
    public function businessInfoStore3(Request $request){

        try{

            $businessOwnerId = TBusinessOwnerInfo::where('id', $request->owner_id)->where('user_id', $request->user()->id)->where('status','>=', 3)->get()->first();
           
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
                $imagePath = '';
            }

            if ($request->hasFile('handcut_certificate')) { 
                $file = $request->file('handcut_certificate');
                $handcut_certificate = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/business/handcut_certificate'), $handcut_certificate);
                $imagePaths = 'images/business/handcut_certificate/' . $handcut_certificate;
            }else{
                $imagePaths = '';
            }

            $businessData = TBusiness::find($businessOwnerId->business_id);          
	        $businessData->creed_tags_id = json_encode($request->creed_tags_id);
            $businessData->restaurant_id = json_encode($request->restaurant_id);
            $businessData->halal_certificate = $imagePath;
            $businessData->handcut_text = $request->handcut_text;
            $businessData->handcut_certificate = $imagePaths;
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
                'errors' => $e->errors(),
            ],422);
        }

    }

    // Business info store step 4
    public function businessInfoStore4(Request $request){
   
        try{

            $businessOwnerId = TBusinessOwnerInfo::where('user_id', $request->user()->id)->where('status', '>=', 4)->get()->first();
            
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
                'errors' => $e->errors(),
            ],422);
        }

    }

    // checkout-page
    // public function checkout(){}

    // business type, category, subcategory, affiliations, creedtags, restaurant list.
    public function allDropDown(){

        $type = TBusinessType::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $category = TBusinessCategory::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $subcategory = TBusinessSubCategory::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $businessTags = TBusinessTags::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $creedTags = TCreedTags::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $affiliation = TAdminAffiliation::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);
        $restaurant = TAdminRestaurant::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        $data =  [
            'type' => $type,
            'category' => $category,
            'subcategory' => $subcategory,
            'creedTags' => $creedTags,
            'businessTags' => $businessTags,
            'affiliation' => $affiliation,
            'restaurant' => $restaurant,
        ];

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function businessType(){

        $data = TBusinessType::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

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

    public function creedTags(){

        $data = TCreedTags::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function affiliationList(){

        $data = TAdminAffiliation::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function restaurantDataList(){

        $data = TAdminRestaurant::where('status', 1)->get()->makeHidden(['created_by','updated_by','created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function countryList(){

        $data = TAdminCountry::select(['id','name'])->get();

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function stateList(Request $request){
        
        if($request->country_id!='null'){
            $data = TAdminState::select(['id','name','country_id'])->where('country_id', $request->country_id)->get();
        }else{
            $data = TAdminState::select(['id','name','country_id'])->get();
        }

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function cityList(Request $request){

        if($request->state_id!='null'){
            $data = TAdminCity::select(['id','name','state_id','country_id'])->where('state_id', $request->state_id)->get();
        }else{
            $data = TAdminCity::select(['id','name','state_id','country_id'])->get();
        }

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function getNearByBusiness(Request $request){
        
        $latitude = $request->input('lat');
        $longitude = $request->input('long');
        $perm = $request->input('perm');
        $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)

        if ($perm == 0) {
            $latitude = '41.850033';         //'40.12150192260742';
            $longitude = '-87.6500523';      //'-100.45039367675781';
            $data = TBusiness::with('operationData:id,business_id,open_time,closed_time','ratings','galleryData:id,business_id,business_gallery_image')->select(
                'id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'country',
                'state',
                'city',
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
            
            ->get()

            ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','created_at','updated_at','deleted_at','ratings']);

            $data = $data->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = $business->averageRating() ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });
    
            return response()->json(['status' => 'success', 'data' => $data], 200);
        }

        // Haversine formula to calculate distance between two points
        $data = TBusiness::with('operationData:id,business_id,open_time,closed_time','ratings','galleryData:id,business_id,business_gallery_image')->select(
            'id',
            'business_name',
            'business_profile_image',
            'business_type_id',
            'business_category_id',
            'business_subcategory_id',
            'creed_tags_id',
            'address',
            'country',
            'state',
            'city',
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
        ->get()

        ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','created_at','updated_at','deleted_at','ratings']);

        $data = $data->map(function ($business) {

            $business->business_type_name = $business->businessTypeName ?? '';
            $business->business_category_name = $business->businessCategory->name ?? '';
            $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
            $business->business_creed_name = $business->creedTagsName ?? '';
            $business->affiliation_name = $business->affiliationName ?? '';
            $business->country_name = $business->countryName->name ?? '';
            $business->state_name = $business->stateName->name ?? '';
            $business->city_name = $business->cityName->name ?? '';
            $business->average_rating = $business->averageRating() ?? '';
            
            unset($business->businessCategory);
            unset($business->businessSubCategory);
            unset($business->countryName);
            unset($business->stateName);
            unset($business->cityName);
            return $business;
        });

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function daysList(){

        $data = TDays::where('status', 1)->get()->makeHidden(['created_at','updated_at']);

        return response()->json(['status' => 'success', 'data' => $data,], 200);
    }

    public function getMultiBusinessList(Request $request){

        $validated = $request->validate([
            'lat' => 'required|string',
            'long' => 'required|string',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
        $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)

        // Convert degrees to radians for calculations
        $multiBusinesses = TBusiness::with('operationData:id,business_id,open_time,closed_time','ratings','galleryData:id,business_id,business_gallery_image')->select(
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
            ->get()

            ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','ratings','created_at','updated_at','deleted_at']);

            $multiBusinesses = $multiBusinesses->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = $business->averageRating() ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });

        return response()->json(['success' => 'success', 'data' => $multiBusinesses]);
    }

    public function getBusinessProfile(Request $request){

        $business_profile = TBusiness::with(['businessOwnerInfos','operationData:id,business_id,day,open_time,closed_time','ratings:id,user_id,business_id,rating_star,description,image,created_at','ratings.user:id,name,first_name,last_name,avatar','galleryData:id,business_id,business_gallery_image'])->select(['id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'country',
                'state',
                'city',
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
                
                ->where('id', $request->id)
                
                ->get()

                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','created_at','updated_at','deleted_at']);
                
                

            $business_profile = $business_profile->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = round((double) $business->averageRating(),2) ?? '';
		$business->rating_count= TBusinessRating::where('business_id', $business->id)->count('id');
                
		// each star count and make percentage start
                $totalRatings = TBusinessRating::where('business_id', $business->id)->count();
                $eachRatingsPercentage = TBusinessRating::select(DB::raw('rating_star, COUNT(*) as count'))->where('business_id', $business->id)->groupBy('rating_star')->pluck('count', 'rating_star'); // [5 => 20, 4 => 10, ...]
                $star_percentages = [];
                foreach (range(1, 5) as $star) {
                    $count = $eachRatingsPercentage[$star] ?? 0; 
                    $star_percentages[$star] = $totalRatings > 0 ? round(($count / $totalRatings) * 100, 2) : 0;
                }
                $business->each_star_percentages = $star_percentages;
                // end

                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });
        
            return response()->json(['status' => 'success', 'message'=>'Business Profile Data Showing Success', 'data' => $business_profile,], 200);
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
           // 'creed_id' => 'required',
        ]);

        $latitude = $validated['lat'];
        $longitude = $validated['long'];
	    $creed_id = $request->creed_id;

        $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)

        if($creed_id){
            // Convert degrees to radians for calculations
            $filterBusinesses = TBusiness::with(['businessOwnerInfos','businessCategory:id,name','businessSubCategory:id,name','galleryData:id,business_id,business_gallery_image','operationData:id,business_id,day,open_time,closed_time','ratings'])->select(
                    'id',
                    'business_name',
                    'business_type_id',
                    'business_category_id',
                    'business_subcategory_id',
                    'creed_tags_id',
                    'lat',
                    'long',
                // DB::raw('`long` AS longitude'),90.4128379
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
        
                ->where(function ($query) use ($creed_id) {
                    foreach ($creed_id as $id) {
                        $query->orWhereJsonContains('creed_tags_id', $id);
                    }
                })
                ->having('distance', '<=', $radius)
                ->orderBy('distance', 'asc')
                ->get()

                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','ratings','created_at','updated_at','deleted_at']);

                $filterBusinesses = $filterBusinesses->map(function ($business) {

                    $business->business_type_name = $business->businessTypeName ?? '';
                    $business->business_category_name = $business->businessCategory->name ?? '';
                    $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                    $business->business_creed_name = $business->creedTagsName ?? '';
                    $business->affiliation_name = $business->affiliationName ?? '';
                    $business->country_name = $business->countryName->name ?? '';
                    $business->state_name = $business->stateName->name ?? '';
                    $business->city_name = $business->cityName->name ?? '';
                    $business->average_rating = $business->averageRating() ?? '';
                    
                    unset($business->businessCategory);
                    unset($business->businessSubCategory);
                    unset($business->countryName);
                    unset($business->stateName);
                    unset($business->cityName);
                    return $business;
                });
            }else{
                // Convert degrees to radians for calculations
                $filterBusinesses = TBusiness::with(['businessOwnerInfos','businessCategory:id,name','businessSubCategory:id,name','galleryData:id,business_id,business_gallery_image','operationData:id,business_id,day,open_time,closed_time','ratings'])->select(
                    'id',
                    'business_name',
                    'business_type_id',
                    'business_category_id',
                    'business_subcategory_id',
                    'creed_tags_id',
                    'lat',
                    'long',
                // DB::raw('`long` AS longitude'),90.4128379
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
                ->get()

                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','ratings','created_at','updated_at','deleted_at']);

                $filterBusinesses = $filterBusinesses->map(function ($business) {

                    $business->business_type_name = $business->businessTypeName ?? '';
                    $business->business_category_name = $business->businessCategory->name ?? '';
                    $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                    $business->business_creed_name = $business->creedTagsName ?? '';
                    $business->affiliation_name = $business->affiliationName ?? '';
                    $business->country_name = $business->countryName->name ?? '';
                    $business->state_name = $business->stateName->name ?? '';
                    $business->city_name = $business->cityName->name ?? '';
                    $business->average_rating = $business->averageRating() ?? '';
                    
                    unset($business->businessCategory);
                    unset($business->businessSubCategory);
                    unset($business->countryName);
                    unset($business->stateName);
                    unset($business->cityName);
                    return $business;
                });

            }

        return response()->json(['success' => 'success', 'data' => $filterBusinesses]);
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
        $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)

        // Convert degrees to radians for calculations
        $filterBusinesses = TBusiness::with(['businessOwnerInfos','businessCategory:id,name','businessSubCategory:id,name','galleryData:id,business_id,business_gallery_image','operationData:id,business_id,day,open_time,closed_time','ratings'])->select(
                'id',
                'business_name',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'lat',
		'long',
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
            ->get()

            ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','ratings','created_at','updated_at','deleted_at']);

            $filterBusinesses = $filterBusinesses->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = $business->averageRating() ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });

        return response()->json(['success' => 'success', 'data' => $filterBusinesses]);
    }

    // get category relations
    public function getCategoryRelation(){
        
        $data = TBusinessCategory::with(['businesses','subcategories'])->get();

        return response()->json(['success' => 'success', 'data' => $data]);
    }

    // get subcategory relations
    public function getSubCategoryRelation(){
        
        $data = TBusinessSubCategory::with(['businesses','category'])->get();

        return response()->json(['success' => 'success', 'data' => $data]);
    }

    // aboutUs
    public function aboutUs(){

        $data = TAboutUs::get()->first()->makeHidden(['status','created_by','updated_by','created_at','updated_at']);   
        $data['individual_description'] = json_decode($data->individual_description);
        $data['business_description'] = json_decode($data->business_description);
        $data['individual_tab_description'] = json_decode($data->individual_tab_description);
        $data['business_tab_description'] = json_decode($data->business_tab_description);

        return response()->json(['success' => 'success', 'data' => $data]);
    }

    // appTermsAndConditions
    public function appTermsAndConditions(){

        $data = TAppTermsAndConditions::get()->first()->makeHidden(['status','created_by','updated_by','created_at','updated_at']);
        $data['page_1_heading'] = json_decode($data->page_1_heading);
        
        return response()->json(['success' => 'success', 'data' => $data]);
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

        return response()->json(['success' => 'success', 'data' => $data]);
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
            $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)
            // Convert degrees to radians for calculations
            $filterBusinesses = TBusiness::with(['businessOwnerInfos','businessCategory:id,name','businessSubCategory:id,name','galleryData:id,business_id,business_gallery_image','operationData:id,business_id,day,open_time,closed_time','ratings'])->select(
                    'id',
                    'business_name',
                    'business_type_id',
                    'business_category_id',
                    'business_subcategory_id',
                    'creed_tags_id',
                    'lat',
		    'long',
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
                ->get()
                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','created_at','updated_at','deleted_at','ratings']);

            $filterBusinesses = $filterBusinesses->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = $business->averageRating() ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });

            return response()->json(['success' => 'success', 'data' => $filterBusinesses]);
        }else{

            $latitude = $validated['lat'];
            $longitude = $validated['long'];
            $catSubCat = $validated['catSubCat'];
            $radius = (100*1.60934); // Radius in kilometers (100 miles to kilometers)
            // Convert degrees to radians for calculations
            $filterBusinesses = TBusiness::with(['businessOwnerInfos','creedTags:id,name:id,name','businessType:id,name','businessCategory:id,name','businessSubCategory:id,name','galleryData:id,business_id,business_gallery_image','operationData:id,business_id,day,open_time,closed_time','ratings','country:id,name','state:id,name','city:id,name'])->select(
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
          ,'ratings.user:id,name,first_name,last_name,avatar'      )
        
                ->whereHas('businessCategory', function($query) use ($catSubCat) {
                    $query->where('name', $catSubCat);})
                ->orWhereHas('businessSubCategory', function($query) use ($catSubCat) {
                    $query->where('name', $catSubCat);})
                ->having('distance', '<=', $radius)
                ->orderBy('distance', 'asc')
                ->get()

                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','ratings','created_at','updated_at','deleted_at']);

                $filterBusinesses = $filterBusinesses->map(function ($business) {

                    $business->business_type_name = $business->businessTypeName ?? '';
                    $business->business_category_name = $business->businessCategory->name ?? '';
                    $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                    $business->business_creed_name = $business->creedTagsName ?? '';
                    $business->affiliation_name = $business->affiliationName ?? '';
                    $business->country_name = $business->countryName->name ?? '';
                    $business->state_name = $business->stateName->name ?? '';
                    $business->city_name = $business->cityName->name ?? '';
                    $business->average_rating = $business->averageRating() ?? '';
                    
                    unset($business->businessCategory);
                    unset($business->businessSubCategory);
                    unset($business->countryName);
                    unset($business->stateName);
                    unset($business->cityName);
                    return $business;
                });

            return response()->json(['success' => 'success', 'data' => $filterBusinesses]);
        }
    }

    // save business list for user wise
    public function saveBusinessList(Request $request){
        
        $userId = $request->user()->id;
        $business_id = $request->business_id;

        $users = User::find($userId);

        if($users->save_business_list==''){
            $users->save_business_list = json_encode($business_id);
            $users->save();
        }else{
            $storeArray = json_decode($users->save_business_list, true);
            $matches = array_intersect($storeArray, $request->business_id);

            if(!$matches){
                $dataArray = array_merge($storeArray, $request->business_id);
                $users->save_business_list = $dataArray;
                $users->save();

                $data = [
                    'userId' => $users->id,
                    'business_id' => $users->save_business_list
                ];

                return response()->json(['success' => 'success', 'message' => 'Save Business List Succesful.', 'data' => $data]);
            }

            $data = [
                'userId' => $userId,
                'business_id' => $business_id
            ];
    
            return response()->json(['success' => 'success', 'message' => 'This Business already listed for this user.', 'data' => $data]);
        }

        $data = [
            'userId' => $userId,
            'business_id' => $business_id
        ];

        return response()->json(['success' => 'success', 'message' => 'Save Business List Succesful.', 'data' => $data]);
    }

    // show saved business list for user wise 
    public function saveBusinessListShow(Request $request){

        $users = User::find($request->user()->id);
        $businessList = json_decode($users->save_business_list); 
        $businessDetails = [];
        foreach($businessList as $value){

            $data = \App\Models\Api\TBusiness::where('id', $value)->get()
            ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city']);

            $data = $data->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                
                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });

            $businessDetails[] = $data;

        }

        $data = [
            'businessList' => $businessDetails,
        ];
        return response()->json(['success' => 'success', 'message' => 'Business Save List.', 'data' => $data]);
    }

    // Business Rating store
    public function businessRating(Request $request){
        
        $validated = $request->validate([
            'business_id' => 'required|exists:t_businesses,id',
            'rating_star' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            // 'image' => 'nullable|mimes:jpeg,jpg,png',
        ]);
	
	$imgePath = [];

        if ($request->file('image')) {
	   foreach ($request->file('image') as $key=>$images) {
             // $file = $request->file('image'); 
                $ratingImage = ++$key.time() . '.' . $images->getClientOriginalExtension();
                $images->move(public_path('images/business/rating'), $ratingImage);
            $imagePath[] = 'images/business/rating/' .$ratingImage;
       	   }
	}

        $ratingData = TBusinessRating::where('user_id', auth()->id())->where('business_id', $request->business_id)->get()->first();

        if($ratingData){
            $rating = TBusinessRating::find($ratingData->id);
            $rating->user_id = auth()->id();
            $rating->business_id = $validated['business_id'];
            $rating->rating_star = $validated['rating_star'];
            $rating->description = $validated['description'];
            $rating->image = $imagePath ?? '';
            $rating->status = 1;
            $rating->save();
        }else{
            $rating = new TBusinessRating();
            $rating->user_id = auth()->id();
            $rating->business_id = $validated['business_id'];
            $rating->rating_star = $validated['rating_star'];
            $rating->description = $validated['description'];
            $rating->image = $imagePath ?? 'null';
            $rating->status = 1;
            $rating->save();
        }

        $business_profile = TBusiness::with(['businessOwnerInfos','operationData:id,business_id,open_time,closed_time','ratings','ratings.user:id,name,first_name,last_name,avatar','galleryData:id,business_id,business_gallery_image'])->select(['id',
                'business_name',
                'business_profile_image',
                'business_type_id',
                'business_category_id',
                'business_subcategory_id',
                'creed_tags_id',
                'address',
                'country',
                'state',
                'city',
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
                
                ->where('id', $request->business_id)
                
                ->get()

                ->makeHidden(['business_type_id','business_category_id','business_subcategory_id','creed_tags_id','affiliation_id','country','state','city','created_at','updated_at','deleted_at']);


            $business_profile = $business_profile->map(function ($business) {

                $business->business_type_name = $business->businessTypeName ?? '';
                $business->business_category_name = $business->businessCategory->name ?? '';
                $business->business_subcategory_name = $business->businessSubCategory->name ?? '';
                $business->business_creed_name = $business->creedTagsName ?? '';
                $business->affiliation_name = $business->affiliationName ?? '';
                $business->country_name = $business->countryName->name ?? '';
                $business->state_name = $business->stateName->name ?? '';
                $business->city_name = $business->cityName->name ?? '';
                $business->average_rating = round((double)$business->averageRating(),2) ?? '';
                $business->rating_count = TBusinessRating::where('business_id', $business->id)->count('id');
	 	
		// each star count and make percentage start
                $totalRatings = TBusinessRating::where('business_id', $business->id)->count();
                $eachRatingsPercentage = TBusinessRating::select(DB::raw('rating_star, COUNT(*) as count'))->where('business_id', $business->id)->groupBy('rating_star')->pluck('count', 'rating_star'); // [5 => 20, 4 => 10, ...]
                $star_percentages = [];
                foreach (range(1, 5) as $star) {
                    $count = $eachRatingsPercentage[$star] ?? 0; 
                    $star_percentages[$star] = $totalRatings > 0 ? round(($count / $totalRatings) * 100, 2) : 0;
                }
                $business->each_star_percentages = $star_percentages;
                // end

                unset($business->businessCategory);
                unset($business->businessSubCategory);
                unset($business->countryName);
                unset($business->stateName);
                unset($business->cityName);
                return $business;
            });

        return response()->json(['success' => 'success', 'message' => 'Rating Submit Successful.', 'data' => $business_profile]);
    }

    // Business Rating view
    public function ratingView(Request $request){
    
        $ratingData = TBusinessRating::where('user_id', $request->user()->id)->where('business_id', $request->business_id)->get()->first()->makeHidden(['status','created_at','updated_at','deleted_at']);
        
        $ratingDataCount = TBusiness::withCount('ratings')->findOrFail($request->business_id);
        $ratingData['average_rating'] = $ratingDataCount->averageRating();

        return response()->json(['success' => 'success', 'message' => 'View Rating.', 'Data' => $ratingData]);

    }
    
    // Business Rating delete
    public function ratingDelete(Request $request){
    
        $ratingData = TBusinessRating::where('user_id', $request->user()->id)->where('business_id', $request->business_id)->get()->first();
        
        $ratingDeleted = TBusinessRating::find($ratingData->id);
        $ratingDeleted->forceDelete();

        return response()->json(['success' => 'success', 'message' => 'Rating Deleted Successful.']);

    }

    public function userDetails(Request $request){
        
	    if($request->business_owner_id!=''){
            
            $user ='';
            $businessOwnerInfo = TBusinessOwnerInfo::with('business','business.galleryData','business.operationData','business.ratings')->find($request->business_owner_id);
        }else{

            $user = User::find($request->user()->id);

            foreach($user->businessOwnerInfos as $value){
                $businessOwnerInfo = TBusinessOwnerInfo::with('business','business.galleryData','business.operationData','business.ratings')->find($value->id);
            }

        }
        
        $data = [
            'user_info' => $user,
            'businessOwnerInfo' => $businessOwnerInfo,
        ];

        return response()->json(['success' => 'success', 'message' => 'User Details:','data'=>$data]);
    }
}
