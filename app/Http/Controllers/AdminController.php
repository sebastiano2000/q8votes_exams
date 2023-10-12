<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->finish){
            $result = Result::where('user_id', Auth::user()->id)->first();
            $count = Question::count();
            $total = $count > 30 ? 30 : $count;

            return view('admin.pages.result.result',[
                'result' => $result,
                'total' => $total,
            ]);
        }

        return view('admin.pages.dashboard');
    }
}
