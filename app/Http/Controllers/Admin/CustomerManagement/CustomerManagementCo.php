<?php

namespace App\Http\Controllers\Admin\CustomerManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Api\TBusinessOwnerInfo;
use Illuminate\Support\Facades\Log;
use Auth;
use DB;

class CustomerManagementCo extends Controller
{
    public function customerList(Request $request){
       
        if(!empty($request->all()) && $request->account_type=='G'){

            $datas = User::where('account_type','G')->get();
            $accountType = 'G';

        }elseif(!empty($request->all()) && $request->account_type=='GB'){

            $datas = User::where('account_type','GB')->get();
            $accountType = 'GB';

        }else{

            $accountType = '';
            $datas = User::get();
        }
        
        return view('admin.customerManagement.index', compact(['datas','accountType']));
    }

    public function customerListEdit($id){

    }

    public function customerDetailsView($id){
        
        $user = User::find($id);
        if($user->account_type == 'G'){
            return view('admin.customerManagement.generalCustomerView', compact(['user']));
        }
        
    }

    public function profileImage(Request $request){
    
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        if ($request->file('avatar')) {

            $file = $request->file('avatar'); 
            $profile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/customerProfile'), $profile);
            $imagePath = 'images/customerProfile/' .$profile;
        }

        $user = User::find($request->id);
        $user->avatar = $imagePath;
        $user->save();

        return redirect()->route('customers-details.view',$request->id)->with('success','Profile Image Successfully Updated');
    }

    public function customerListDelete($id){
    
        try{
            $users = User::with(['businessOwnerInfos','businessOwnerInfos.business','businessOwnerInfos.business.galleryData','businessOwnerInfos.business.operationData','businessOwnerInfos.business.ratings'])->find($id);
  
            foreach($users->businessOwnerInfos as $value){
                
                $ownerInfo = TBusinessOwnerInfo::with(['business','business.galleryData','business.operationData','business.ratings'])->find($value->id);
                    
                if(!empty($ownerInfo->business)){ $data [] = $ownerInfo->business;
                    
                    $ownerInfo->business->galleryData()->delete();
                    $ownerInfo->business->operationData()->delete();
                    $ownerInfo->business->ratings()->delete();
                }

                $ownerInfo->business()->delete();
            }
      
            $users->delete();

            return redirect()->route('customers.list')->with('danger','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }

    public function customerArchiveList(){
        
        $archiveData = User::get();
        return view('admin.customerManagement.index', compact('archiveData'));
    }
}
