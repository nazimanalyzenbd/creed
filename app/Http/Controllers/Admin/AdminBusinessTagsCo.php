<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TBusinessTags;
use Auth;

class AdminBusinessTagsCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TBusinessTags::get();
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
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'nullable',
        ]);

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
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'nullable',
        ]);

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

        return redirect()->route('business-tags.index')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TBusinessTags::find($id);
        $data->delete();

        return redirect()->route('business-tags.index')->with('success','Data Deleted Successfully');
    }
}
