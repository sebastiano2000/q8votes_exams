<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'phone',
        'password',
        'session_limit',
        'logintoken',
        'role_id',
        'suspend',
        'finish'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    static function upsertInstance($request)
    {
        if ($request->password) {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role_id' => 2,
                ]
            );
        } else {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                ]
            );
        }

        return $user;
    }

    static function statusUpdate($request)
    {
        return User::where('id', $request->id)->update(['suspend' => $request->suspend]);
    }

    static function limitUpdate($request)
    {
        return User::where('id', $request->id)->update(['session_limit' => $request->limit]);
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%')
                ->orWhere('phone', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    static function modifyPassword($request)
    {
        $user = User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
    }

    //Roles
    public function isAdmin()
    {
        return Auth::user()->role_id == ADMIN;
    }

    public function deleteInstance()
    {
        return $this->delete();
    }

    public function list()
    {
        return $this->hasMany(UserFav::class);
    }
}
