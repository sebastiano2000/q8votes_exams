<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparator extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
    static function upsertInstance($request)
    {
        $preparator = Preparator::updateOrCreate(
            [
                'id' => $request->id ?? null,
            ],
                $request->all()
            );

        
        if ($request->file('picture')) {
            // $name = 'picture_'.$preparator->id . '.' . $request->file('picture')->getClientOriginalExtension();
            // $image = $request->file('picture');
            // $image->move(public_path('preparators/'.$preparator->id), $name);
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/preparators/';
            $file->move($destinationPath, $filename);

            $preparator->picture()->updateOrCreate(
                [
                    'imageable_id' => $preparator->id,
                    'use_for' => 'picture'
                ],
                [
                    'name' => $filename,
                    'use_for' => 'picture'
                ]);
        }

        return $preparator;
    }
    
    public function scopeFilter($query,$request)
    {
        if ( isset($request['name']) ) {
            $query->where('name','like','%'.$request['name'].'%');
        }

        return $query;
    }
    
    public function deleteInstance()
    {
        return $this->delete();
    }
    
    public function picture()
    {
        return $this->morphOne(Gallary::class,'imageable')->where('use_for','picture');
    }
}
