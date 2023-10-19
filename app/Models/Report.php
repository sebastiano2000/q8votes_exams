<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'notes',
    ];

    static function upsertInstance($request)
    {
        $report = Report::updateOrCreate(
            [
                'id' => $request->id ?? null
            ],
            [
                'user_id' => Auth::user()->id,
                'question_id' => $request->question_id,
                'notes' => $request->notes,
            ]
        );

        return $report;
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->whereHas('question', function($query) use($request){
                $query->where('title', 'like', '%' . $request['name'] . '%');
            })->get();
        }

        return $query;
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
