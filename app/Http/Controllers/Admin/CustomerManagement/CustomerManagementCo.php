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

        if($request->customer_type=='G'){
            $datas = User::where('account_type','G')->get();
        }elseif($request->customer_type=='GB'){
            $datas = User::where('account_type','GB')->get();
        }else{
            $datas = User::get();
        }
        
        return view('admin.customerManagement.index', compact('datas'));
    }

    public function customerListEdit($id){

    }

    public function customerListDelete($id){
    
        try{
            $user = User::with(['businessOwnerInfos','businessOwnerInfos.business','businessOwnerInfos.business.operationData','businessOwnerInfos.business.galleryData'])->find($id);
            // $ownerInfo = TBusinessOwnerInfo::with(['business'])->where('user_id', $id)->get();
            dd($user);
            // $data->delete();

            return redirect()->route('affiliations.index')->with('danger','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }
}
