<?php

namespace App\Observers;

use App\Models\UserResult;
use Auth;
use Log;

class UserResultObserver
{
    public function created(UserResult $result)
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $result->id,
            'message' => "لقد قام " . Auth::user()->name . " بالإجابة علي السؤال رقم " . $result->question_id . " في اختبار مادة " . $result->question->subject->name,
            'action_model' => $result->getTable(),
        ]);
    }

    public function updated(UserResult $result)
    {
        Log::create([
            'user_id'      => Auth::user()->id,
            'action'       => 'updated',
            'action_id'    => $result->id,
            'message' => "لقد قام " . Auth::user()->name . " بالإجابة علي السؤال رقم " . $result->question_id . " في اختبار مادة " . $result->question->subject->name,
            'action_model' => $result->getTable(),
        ]);
    }
}
