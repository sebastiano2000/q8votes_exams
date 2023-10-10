<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard', ['tenants' => []]);
    }
    
    public function getData(Request $request)
    {
        return Tenant::data($request);
    }
}
