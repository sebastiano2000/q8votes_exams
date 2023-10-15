<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Verification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['verification_id', 'phone'];

    static function saveVerification($request)
    {
        return self::updateOrCreate(
            [
                'phone' => $request->phone
            ],
            [
                'verification_id' => Hash::make($request->verification_id),
                'phone' => $request->phone
            ]
        );
    }

    static function verifiyId($request)
    {
        $get_verification_data = self::where(['phone' => $request->phone])->first();
        if ($get_verification_data->count()) {
            if (Hash::check($request->verification, $get_verification_data->verification_id)) {
                return ['status' => true];
            }
        }
        return ['status' => false];
    }
}
