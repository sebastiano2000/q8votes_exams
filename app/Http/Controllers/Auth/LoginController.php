<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'phone';
    }

    public function login(LoginRequest $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!password_verify($request->password, $user->password)) {
            return redirect()->back();
        }

        $tokens = explode(',', $user->logintoken);

        if (isset($_COOKIE["logintoken"])) {
            if (in_array($_COOKIE["logintoken"], $tokens, true)) {
                if ($this->attemptLogin($request)) {
                    Log::create([
                        'user_id'      => Auth::user()->id,
                        'action'       => 'created',
                        'action_id'    => Auth::user()->id,
                        'message' => "لقد قام " . Auth::user()->name . " بتسجيل الدخول من جهاز مسجل ",
                        'action_model' =>  'users',
                    ]);

                    $user = Auth::user();
                    
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }
                    $user->save();

                    return $this->sendLoginResponse($request);
                }
            } else {
                if (count($tokens) > $user->session_limit) {
                    return redirect()->back()->withErrors(['session' => 'لقد تجاوزت الحد الأقصي للأجهزة']);
                }

                $token =  bin2hex(random_bytes(32));
                $time = time() + (365 * 24 * 60);
                setcookie('logintoken', $token, $time);

                if ($this->attemptLogin($request)) {
                    $user = Auth::user();
                    
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }

                    $tokens[] = $token;
                    $user->logintoken = implode(',', $tokens);
                    $user->save();

                    return $this->sendLoginResponse($request);
                }
            }
        }

        if (count($tokens) >= $user->session_limit) {
            return redirect()->back()->withErrors(['session' => 'لقد تجاوزت الحد الأقصي للأجهزة']);
        }

        $token =  bin2hex(random_bytes(32));
        $time = time() + (365 * 24 * 60);
        setcookie('logintoken', $token, $time);

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            $tokens[] = $token;
            $user->logintoken = implode(',', $tokens);
            $user->save();
            return $this->sendLoginResponse($request);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request)
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
}
