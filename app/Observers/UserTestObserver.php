<?php

namespace App\Observers;

use App\Models\UserTest;
use Auth;
use App\Models\Log;

class UserTestObserver
{
    public function created(UserTest $result)
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $result->id,
            'message' => "لقد قام " . Auth::user()->name . " بالإجابة علي السؤال رقم " . $result->question_id . " في مراجعة مادة " . $result->question->subject->name,
            'action_model' => $result->getTable(),
        ]);
    }

    public function updated(UserTest $result)
    {
        Log::create([
            'user_id'      => Auth::user()->id,
            'action'       => 'updated',
            'action_id'    => $result->id,
            'message' => "لقد قام " . Auth::user()->name . " بالإجابة علي السؤال رقم " . $result->question_id . " في مراجعة مادة " . $result->question->subject->name,
            'action_model' => $result->getTable(),
        ]);
    }
}
