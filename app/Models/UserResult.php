<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'question_id',
        'answer_id',
        'result'
    ];

    static function enterResult($request)
    {
        $answer = Answer::where('id', $request->answer_id)->first();

        $user_result = UserResult::updateOrCreate(
            [
                'question_id' => $request->question_id,
                'user_id' => Auth::user()->id,
            ],
            [
                'question_id' => $request->question_id,
                'user_id' => Auth::user()->id,
                'answer_id' => $request->answer_id,
                'result' => $answer->status,
            ]
        );

        return true;
    }
}