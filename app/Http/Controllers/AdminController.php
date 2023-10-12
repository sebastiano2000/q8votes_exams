<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
