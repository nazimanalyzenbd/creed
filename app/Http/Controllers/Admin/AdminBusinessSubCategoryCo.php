<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TBusinessSubCategory;
use App\Models\Admin\TBusinessCategory;
use App\Http\Requests\TBusinessSubCategoryRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Auth;

class AdminBusinessSubCategoryCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TBusinessSubCategory::latest()->get();
        return view('admin.businessSubCategory.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TBusinesscategory::where('status', 1)->get();
        return view('admin.businessSubCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TBusinessSubCategoryRequest $request)
    {
        // Validate the form data
        $validated = $request->validated();
        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }
        
            $data = New TBusinessSubCategory();
            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->status = $status;
            $data->created_by = Auth::id();
            $data->save();

            return redirect()->route('business-subcategory.index')->with('success','Data Save Successfully');
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
        $data = TBusinessSubCategory::find($id);
        $categories = TBusinesscategory::where('status', 1)->get();

        return view('admin.businessSubCategory.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TBusinessSubCategoryRequest $request, string $id)
    {
        // Validate the form data
        $validated = $request->validated();
        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }
        
            $data = TBusinessSubCategory::find($id);
            $data->name = $request->name;
            $data->status = $status;
            $data->created_by = Auth::id();
            $data->save();

            return redirect()->route('business-subcategory.index')->with('info','Data Updated Successfully');
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
            $data = TBusinessSubCategory::find($id);
            $data->delete();

            return redirect()->route('business-subcategory.index')->with('danger','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }
}
