<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_id',
        'result'
    ];

    static function enterResult($request)
    {
        $answer = Answer::where('id', $request->answer_id)->first();

        $user_result = UserTest::updateOrCreate(
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

        return Answer::where('question_id', $answer->question_id)->where('status', 1)->first()->id;
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
