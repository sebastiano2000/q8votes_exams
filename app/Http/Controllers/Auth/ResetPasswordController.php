<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckRequest;
use App\Http\Requests\Auth\PasswordRequest;
use App\Models\User;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index()
    {
        return view('auth.passwords.forget-password');
    }

    public function check(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            return view(
                'auth.passwords.verification',
                [
                    'user' => $user,
                    'country_code' => $request->countryCode
                ]
            );
        }

        return redirect()->route('login');
    }

    public function changePassword(CheckRequest $request)
    {

        return Verification::saveVerification($request);
    }

    public function changeForm(Request $request)
    {
        if (Verification::verifiyId($request)['status'] == false) {
            return redirect()->route('forget-password.reset');
        }
        return view('auth.passwords.change-password', [
            'phone' => $request->phone,
        ]);
    }

    public function store(PasswordRequest $request)
    {

        User::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);

        return view('auth.passwords.success');
    }

    public function success()
    {
        return view('auth.passwords.success');
    }
}
