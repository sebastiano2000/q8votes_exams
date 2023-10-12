<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function enterTotal(Request $request)
    {
        $result = Result::enterTotal($request);

        return view('admin.pages.result.result',[
            'result' => $result,
        ]);
    }
}
