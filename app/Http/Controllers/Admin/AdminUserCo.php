<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TAdminUser;
use Spatie\Permission\Models\Role;
use App\Http\Requests\TAdminUserRequest;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUserCo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TAdminUser::latest()->get();
  
        return view('admin.userManagement.users.index',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        $country = DB::table('countries')->get();

        return view('admin.userManagement.users.create',compact('roles','country'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TAdminUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $tAdminUser = TAdminUser::create($input);
        $tAdminUser->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = TAdminUser::find($id);

        return view('admin.userManagement.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $adminUser = TAdminUser::find($id);
        $country = DB::table('countries')->get();
        $roles = Role::pluck('name','name')->all();
        $userRole = $adminUser->roles->pluck('name','name')->all();
    
        return view('admin.userManagement.users.edit',compact('adminUser','roles','userRole','country'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TAdminUserRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $tAdminUser = TAdminUser::find($id);
        $tAdminUser->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $tAdminUser->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')->with('info','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        TAdminUser::find($id)->delete();
        return redirect()->route('users.index')->with('warning','User deleted successfully');
    }
}
