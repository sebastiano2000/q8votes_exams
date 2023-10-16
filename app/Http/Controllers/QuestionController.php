<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\UserResult;
use App\Models\UserTest;
use Auth;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function exam(Request $request)
    {
        if(Auth::user()->finish){
            Auth::user()->update(['finish' => 0]);
            UserResult::where('user_id', Auth::user()->id)->delete();
        }

        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;

        $count = Question::count();
        $total = $count > 30 ? 30 : $count;

        $array_questions = session()->get('exam.data');

        if($array_questions){
            $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->inRandomOrder()->with('answers')->take(1)->first();
            $array_questions->push($array_question);
        }
        else {
            $array_questions = Question::inRandomOrder()->with('answers')->take(1)->get();
        }

        session()->put('exam.data', $array_questions);

        $slice = $array_questions->slice($offset, 1);
        
        return view('admin.pages.exam.index')
            ->with('slice', $slice)
            ->with('page', $page)
            ->with('total', $total);
    }

    public function test(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $count = Question::count();
        
        $questions = Question::inRandomOrder()->with('answers')->get();
        $slice = $questions->first();

        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;

        $count = Question::count();
        $array_questions = UserTest::where('user_id', Auth::user()->id)->pluck('question_id');

        if($array_questions){
            $question = Question::whereNotIn('id', $array_questions)->inRandomOrder()->with('answers')->take(1)->first();
        }
        else {
            $question = Question::inRandomOrder()->with('answers')->take(1)->get();
        }

        if(!$question){
            UserTest::where('user_id', Auth::user()->id)->delete();
            $question = Question::inRandomOrder()->with('answers')->take(1)->get();
        }

        return view('admin.pages.exam.test')
            ->with('slice', $question)
            ->with('page', $page)
            ->with('total', $count);
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
