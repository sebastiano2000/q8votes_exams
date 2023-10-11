<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Hesabe\Controllers\PaymentController;
use Image;
use Session;

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

    protected static function booted()
    {
        if (Auth::hasUser()) {
            if (!Auth::user()->isSuperAdmin()) {
                static::addGlobalScope(new TenantScope());
            }
        }
    }

    static function upsertInstance($request)
    {
        $request->merge([
            'password' => Hash::make($request->password),
        ]);

        if ($request->password) {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                $request->all()
            );
        } else {
            $user = User::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => $request->role_id,
                    'national_id' => $request->national_id,
                ]
            );
        }

        $name = 'picture_' . $user->id . '.png';
        $name2 = 'contract_' . $user->id . '.png';

        if ($request->file('picture')) {
            if (!file_exists(public_path('users/' . $user->id . '/'))) {
                mkdir(public_path('users/' . $user->id . '/'));
            }

            $image = $request->file('picture');

            Image::make($image)->save(public_path('users/' . $user->id . '/') . $name);

            $user->picture()->updateOrCreate(
                [
                    'imageable_id' => $user->id,
                    'use_for' => 'picture'
                ],
                [
                    'name' => $name,
                    'use_for' => 'picture'
                ]
            );
        }

        if ($request->file('contract')) {
            if (!file_exists(public_path('users/' . $user->id . '/'))) {
                mkdir(public_path('users/' . $user->id . '/'));
            }

            $image = $request->file('contract');

            Image::make($image)->save(public_path('users/' . $user->id . '/') . $name2);

            $user->contract()->updateOrCreate(
                [
                    'imageable_id' => $user->id,
                    'use_for' => 'contract'
                ],
                [
                    'name' => $name2,
                    'use_for' => 'contract'
                ]
            );
        }

        return $user;
    }

    static function modifyPassword($request)
    {
        $user = User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
    }

    static function userSelect($request)
    {
        $results = count($request->term) == 2 ? User::where(function ($query) {
            $query->where('role_id', OWNER)
                ->orWhere('role_id', SUPERADMIN);
        })->where('name', 'like', '%' . $request->term["term"] . '%')->take(10)->get()->toArray() : User::filter($request->all())->where('role_id', OWNER)->orWhere('role_id', SUPERADMIN)->take(10)->get()->toArray();

        return response()->json($results);
    }


    public function scopeFilter($query, $request)
    {
        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%')
                ->orWhere('national_id', 'like', '%' . $request['name'] . '%')
                ->orWhere('email', 'like', '%' . $request['name'] . '%')
                ->orWhere('phone', 'like', '%' . $request['name'] . '%');
        }

        return $query;
    }

    //Roles
    public function isSuperAdmin()
    {
        return Auth::user()->role_id == SUPERADMIN;
    }

    public function isOwner()
    {
        return Auth::user()->role_id == OWNER;
    }

    public function isTenant()
    {
        return Auth::user()->role_id == TENANT;
    }

}
