<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFav extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
    ];

    static function saveList($request)
    {
        if($request->result == 'true'){
            $user_list = UserFav::updateOrCreate(
                [
                    'question_id' => $request->question_id,
                    'user_id' => Auth::user()->id,
                ],
                [
                    'question_id' => $request->question_id,
                    'user_id' => Auth::user()->id,
                ]
            );
        }
        else {
            $userfav = UserFav::where('question_id', $request->question_id)->where('user_id', Auth::user()->id)->delete();

            Log::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'deleted',
                'action_id'    => $userfav,
                'message' => "لقد قام " . Auth::user()->name . " بحذف السوال رقم " . $request->question_id . " من المفضلة",
                'action_model' => 'user_favs',
            ]);
        }

        return true;
    }
}
