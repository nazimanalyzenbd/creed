<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TBusinessTags;
use App\Http\Requests\TBusinessTagsRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Auth;

class AdminBusinessTagsCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TBusinessTags::latest()->get();
        return view('admin.businessTags.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.businessTags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TBusinessTagsRequest $request)
    {
        // Validate the form data
        $validated = $request->validated();
        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }
        
            $data = New TBusinessTags();
            $data->name = $request->name;
            $data->status = $status;
            $data->created_by = Auth::id();
            $data->save();

            return redirect()->route('business-tags.index')->with('success','Data Save Successfully');
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
        $data = TBusinessTags::find($id);
        return view('admin.businessTags.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TBusinessTagsRequest $request, string $id)
    {
      
        $validated = $request->validated();
        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }
        
            $data = TBusinessTags::find($id);
            $data->name = $request->name;
            $data->status = $status;
            $data->created_by = Auth::id();
            $data->save();

            return redirect()->route('business-tags.index')->with('info','Data Updated Successfully');
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
            $data = TBusinessTags::find($id);
            $data->delete();

            return redirect()->route('business-tags.index')->with('danger','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }
}
