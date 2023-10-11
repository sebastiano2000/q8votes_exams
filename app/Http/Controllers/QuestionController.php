<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function exam(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = "1";
        $offset = ($page - 1) * $perpage;
        
        $questions = Question::with('answers')->get();
        $slice = $questions->slice($offset, 1);

        return view('admin.pages.exam.index')->with('slice', $slice)
            ->with('page', $page);
    }

    public function test(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = "1";
        $offset = ($page - 1) * $perpage;
        
        $questions = Question::with('answers')->get();
        $slice = $questions->slice($offset, 1);

        return view('admin.pages.exam.test')->with('slice', $slice)
            ->with('page', $page);
    }
}
