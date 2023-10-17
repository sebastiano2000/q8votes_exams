<?php

namespace App\Observers;

use App\Models\Result;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ResultObserver
{
    public function created(Result $result)
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $result->id,
            'message' => "لقد قام " . Auth::user()->name . " باداء الاختبار ",
            'action_model' => $result->getTable(),
        ]);
    }

    public function updated(Result $result)
    {
        Log::create([
            'user_id'      => Auth::user()->id,
            'action'       => 'updated',
            'action_id'    => $result->id,
            'message'   =>   " لقد قام  " .Auth::user()->name .'' . 'باعدة الاختبار'.  $result->name ,
            'action_model' => $result->getTable(),
        ]);
    }
}
