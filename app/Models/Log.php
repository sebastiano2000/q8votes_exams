<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'message', 'action_model',  'action_id' ,'user_name', 'clinic_id'];

    //Scopes
    public function scopeFilter($query,$request)
    {
        if ( isset($request['name']) ) {
            $query->where('message','like','%'.$request['name'].'%');
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
