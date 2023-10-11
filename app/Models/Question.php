<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    static function upsertInstance($request)
    {
        // dd($request);
        $question = Question::updateOrCreate(
            [
                'id' => $request->id ?? null
            ],
            [
                'title' => $request->name,
            ]
        );

        $question->answers()->delete();

        foreach($request->title as $key => $title){
            Answer::create(
                [
                    'question_id' => $question->id,
                    'title' => $title,
                    'status' => $request->status[$key],
                ]
            );
        }

        return $question;
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('title', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    public function deleteInstance()
    {
        return $this->delete();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
