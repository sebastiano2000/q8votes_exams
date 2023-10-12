<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->finish){
            $result = Result::where('user_id', Auth::user()->id)->first();

            return view('admin.pages.result.result',[
                'result' => $result,
            ]);
        }

        return view('admin.pages.dashboard');
    }
}
