<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TBusinessType;
use App\Http\Requests\TBusinessTypeRequest;
use Auth;

class AdminBusinessTypeCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TBusinessType::latest()->get();
        return view('admin.businessType.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.businessType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TBusinessTypeRequest $request)
    {
        // Validate the form data
        $validated = $request->validated();

        if($request->status){
            $status = $request->status;
        }else{
            $status = 0;
        }
       
        $data = New TBusinessType();
        $data->name = $request->name;
        $data->status = $status;
        $data->created_by = Auth::id();
        $data->save();

        return redirect()->route('business-type.index')->with('success','Data Save Successfully');
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
        $data = TBusinessType::find($id);
        return view('admin.businessType.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TBusinessTypeRequest $request, string $id)
    {
        // Validate the form data
        $validated = $request->validated();

        if($request->status){
            $status = $request->status;
        }else{
            $status = 0;
        }
       
        $data = TBusinessType::find($id);
        $data->name = $request->name;
        $data->status = $status;
        $data->created_by = Auth::id();
        $data->save();

        return redirect()->route('business-type.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TBusinessType::find($id);
        $data->delete();

        return redirect()->route('business-type.index')->with('success','Data Deleted Successfully');
    }
}
