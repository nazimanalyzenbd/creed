<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TCompanyInfoRequest;
use App\Models\Admin\TCompanyInfo;
use Illuminate\Http\Request;
use DB;

class AdminCompanyInfoCo extends Controller
{
    public function index(TCompanyInfo $tCompanyInfo=null){

        $country = DB::table('countries')->get();

        return view('admin.company_info.index', compact('country'));
        
    }

    public function store(TCompanyInfoRequest $request, TCompanyInfo $tCompanyInfo = null)
    {
        $validator = $request->validated();
dd($validator);
        $tCompanyInfo = $tCompanyInfo ? $tCompanyInfo : new TCompanyInfo;
        
        $logo = 'default.jpg';
        if ($request->hasFile('logo')) {
            $file = request()->file('logo');
            $logo = time() . "-" . request('logo')->getClientOriginalName();
            $logo = str_replace(' ', '-', $logo);
            Image::make($file)->fit(370, 253, function ($constraint) {
            $constraint->aspectRatio();
            })->encode()->save(storage_path('/app/public/uploads/coompanyInfo/') . $logo);           
        }

        $favicon_icon = 'default.jpg';
        if ($request->hasFile('favicon_icon')) {
            $file = request()->file('favicon_icon');
            $favicon_icon = time() . "-" . request('favicon_icon')->getClientOriginalName();
            $favicon_icon = str_replace(' ', '-', $favicon_icon);
            Image::make($file)->fit(370, 253, function ($constraint) {
            $constraint->aspectRatio();
            })->encode()->save(storage_path('/app/public/uploads/coompanyInfo/') . $favicon_icon);           
        }

        $tCompanyInfo['favicon_icon'] = $favicon_icon;

        $tCompanyInfo->fill($validator);
        $tCompanyInfo->save();

        return redirect()->route('company-info.index')->with('success', 'Company Info saved successfully!');
    }
}
