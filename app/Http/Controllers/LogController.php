<?php

namespace App\Http\Controllers;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pages.log.index',[
            'logs' => Log::filter($request->all())->paginate(50)
        ]);
    }

    public function filter(Request $request)
    {
        return view('admin.pages.log.index',[
            'logs' => Log::filter($request->all())->paginate(50)
        ]);
    }
}
