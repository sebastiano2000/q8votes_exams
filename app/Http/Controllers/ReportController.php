<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.reports.index',[
                'reports' => Report::filter($request->all())->paginate(50),
            ]);
        else 
            abort(404);
    }

    public function modify(Request $request)
    {
        return Report::upsertInstance($request);
    }

    public function filter(Request $request)
    {
        return view('admin.pages.reports.index',[
            'reports' => Report::filter($request->all())->paginate(50)
        ]);
    }
}
