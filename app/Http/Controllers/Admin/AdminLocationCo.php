<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TAdminUser;
use App\Models\Admin\TAdminState;
use App\Models\Admin\TAdminCity;
use DB;

class AdminLocationCo extends Controller
{
    public function getStates($country_id)
    {
        $states = TAdminState::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function getCities($state_id)
    {
        $cities = TAdminCity::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
    
}
