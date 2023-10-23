<?php

namespace App\Observers;

use App\Models\UserFav;
use Auth;
use Log;

class UserFavObserver
{
    public function created(UserFav $userfav)
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $userfav->id,
            'message' => "لقد قام " . Auth::user()->name . " باضافة السوال رقم " . $userfav->question_id . " الي المفضلة",
            'action_model' => $userfav->getTable(),
        ]);
    }

    public function deleted(UserFav $userfav)
    {
        Log::create([
            'user_id'      => Auth::user()->id,
            'action'       => 'deleted',
            'action_id'    => $userfav->id,
            'message' => "لقد قام " . Auth::user()->name . " بحذف السوال رقم " . $userfav->question_id . " من المفضلة",
            'action_model' => $userfav->getTable(),
        ]);
    }
}
