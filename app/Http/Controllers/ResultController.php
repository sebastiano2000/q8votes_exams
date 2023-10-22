<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Auth;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.result.index',[
                'results' => Result::filter($request->all())->paginate(50),
            ]);
        else 
            abort(404);
    }

    public function enterTotal(Request $request)
    {
        $result = Result::enterTotal($request);
        $count = Question::count();

        return view('admin.pages.result.result',[
            'result' => $result,
        ]);
    }

    public function filter(Request $request)
    {
        return view('admin.pages.result.index',[
            'results' => Result::filter($request->all())->paginate(50)
        ]);
    }
}
