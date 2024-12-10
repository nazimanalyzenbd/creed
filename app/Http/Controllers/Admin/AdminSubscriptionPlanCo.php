<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TAdminCountry;
use App\Models\Admin\TAdminSubscriptionPlan;
use App\Http\Requests\TAdminSubscriptionPlanRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Auth;

class AdminSubscriptionPlanCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TAdminSubscriptionPlan::latest()->get();
        return view('admin.subscriptionPlan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = TAdminCountry::get();
        return view('admin.subscriptionPlan.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TAdminSubscriptionPlanRequest $request)
    {

        $validated = $request->validated();
        try {
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }
            
            $validated['status'] = $status;
            $validated['created_by'] = Auth::id();

            $data = TAdminSubscriptionPlan::create($validated);

            return redirect()->route('subscription-plan.index')->with('success','Data Save Successfully');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: Unable to submit data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = TAdminSubscriptionPlan::find($id);
        $country = TAdminCountry::get();
        return view('admin.subscriptionPlan.edit', compact('data','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TAdminSubscriptionPlanRequest $request, string $id)
    {
        $validated = $request->validated();
        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }

            if($request->discount!=''){
                $discount = $request->discount;
            }else{
                $discount = 0;
            }
            
            $data = TAdminSubscriptionPlan::find($id);
            $validated['discount'] = $discount;
            $validated['status'] = $status;
            $validated['updated_by'] = Auth::id();
            $data->update($validated);

            return redirect()->route('subscription-plan.index')->with('info','Data Updated Successfully');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: Unable to update data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = TAdminSubscriptionPlan::find($id);
            $data->delete();

            return redirect()->route('subscription-plan.index')->with('danger','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }
}
