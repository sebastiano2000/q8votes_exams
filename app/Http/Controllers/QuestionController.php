<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\UserResult;
use App\Models\UserTest;
use Auth;
use Illuminate\Http\Request;
use App\Imports\ImportQuestion;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function exam(Request $request)
    {
        
        $page = !empty($request->input('page')) ? $request->input('page') : '1';
        $perpage = '1';
        $offset = ($page - 1) * $perpage;
        
        if ($page == '1') {
            Auth::user()->update(['finish' => 0]);
            UserResult::where('user_id', Auth::user()->id)->delete();
        }
        
        $count = Question::where('subject_id', $request->subject_id)->count();
        $total = $count > 30 ? Subject::where('id', $request->subject_id)->first()->questions_count : $count;

        $array_questions = session()->get('exam.data');

        if($array_questions && $array_questions->where('id', $array_questions->pluck('id')->first())->where('subject_id', $request->subject_id)->first()){
            $array_question = Question::whereNotIn('id', $array_questions->pluck('id'))->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();

            if($array_question){
                $array_questions->push($array_question);
            }
            else {
                $array_questions = Question::inRandomOrder()->where('subject_id', $request->subject_id)->with('answers')->take(1)->get();
            }
        }
        else {
            $array_questions = Question::inRandomOrder()->where('subject_id', $request->subject_id)->with('answers')->take(1)->get();
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
        $perpage = '1';
        $offset = ($page - 1) * $perpage;
        $count = Question::count();

        $back_questions = session()->get('test.data') ?? [];

        // if(count($back_questions) > 10){
        //     array_shift($back_questions);
        // }

        $temp = -1;

        foreach ($back_questions as $key => $back_question) {
            if ($back_question[$offset] ?? null) {
                $temp = $key;
            }
        }

        if($back_questions && $temp != -1){
            $question = Question::where('id', $back_questions[$temp][$offset]['id'])->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();

            if(!$question){
                $array_questions = UserTest::where('user_id', Auth::user()->id)->pluck('question_id');

                if($array_questions){
                    $question = Question::whereNotIn('id', $array_questions)->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
                }
                else {
                    $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->get();
                }

                if(!$question){
                    UserTest::where('user_id', Auth::user()->id)->delete();
                    $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->get();
                }

                $offset_array[$offset] = [ 'id' => $question->id ];
                array_push($back_questions, $offset_array);

                session()->put('test.data', $back_questions);
            }
        }
        else {
            $array_questions = UserTest::where('user_id', Auth::user()->id)->pluck('question_id');

            if($array_questions){
                $question = Question::whereNotIn('id', $array_questions)->where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->first();
            }
            else {
                $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->get();
            }

            if (!$question) {
                UserTest::where('user_id', Auth::user()->id)->delete();
                $question = Question::where('subject_id', $request->subject_id)->inRandomOrder()->with('answers')->take(1)->get();
            }

            $offset_array[$offset] = ['id' => $question->id];
            array_push($back_questions, $offset_array);
        }

        session()->put('test.data', $back_questions);

        return view('admin.pages.exam.test')
            ->with('slice', $question)
            ->with('page', $page)
            ->with('total', $count);
    }

    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.question.index', [
                'questions' => Question::filter($request->all())->paginate(50),
                'subjects' => Subject::all(),
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Question $question)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.question.upsert', [
                'subjects' => Subject::all(),
                'question' => $question,
            ]);
        } else {
            abort(404);
        }
    }

    public function modify(QuestionRequest $request)
    {
        return Question::upsertInstance($request);
    }

    public function import(Request $request)
    {
        Excel::import(new ImportQuestion($request->subject_id), $request->file('file')->store('files'));

        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        return $question->deleteInstance();
    }

    public function filter(Request $request)
    {
        return view('admin.pages.question.index', [
            'questions' => Question::filter($request->all())->paginate(50),
            'subjects' => Subject::all(),
        ]);
    }
}
