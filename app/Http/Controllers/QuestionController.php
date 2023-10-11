<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Auth;
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

    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.question.index',[
                'questions' => Question::filter($request->all())->paginate(50),
            ]);
        else 
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Question $question)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.question.upsert',[
                'question' => $question,
            ]);
        else 
            abort(404);
    }

    public function modify(QuestionRequest $request)
    {
        return Question::upsertInstance($request);
    }

    public function destroy(Question $question)
    {
        return $question->deleteInstance();
    }

    public function filter(Request $request)
    {
        return view('admin.pages.question.index',[
            'questions' => Question::filter($request->all())->paginate(50)
        ]);
    }
}
