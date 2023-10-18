<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'questions_count',
    ];

    public static function upsertInstance($request)
    {
        return Subject::updateOrCreate(
            [
                'id' => $request->id ?? null
            ],
            [
                'name' => $request->name,
                'questions_count' => $request->questions_count,
            ]
        );
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    public function deleteInstance()
    {
        $this->questions()->delete();
        $this->delete();
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
