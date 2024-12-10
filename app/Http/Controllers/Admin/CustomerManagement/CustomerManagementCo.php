<?php

namespace App\Http\Controllers\Admin\CustomerManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;

class CustomerManagementCo extends Controller
{
    public function customerList(){

        $datas = User::get();
        return view('admin.customerManagement.index', compact('datas'));
    }
}
