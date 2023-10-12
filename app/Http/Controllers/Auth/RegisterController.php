<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(UserRequest $request)
    {
        // remove white space from phone number
        $phone = preg_replace('/\s+/', '', $request->phone);

        $request->session()->put(
            'user',
            [
                'name' => $request->name,
                'phone' => $phone,
                'password' => $request->password,
                'country_code' => $request->countryCode,
            ]
        );

        return redirect()->route('register.verification');
    }

    public function verification()
    {
        $user = session()->get('user');
        return view(
            'auth.verification',
            [
                'user' => $user,
            ]
        );
    }

    public function success()
    {
        $user = session()->get('user');
        return view(
            'auth.success',
            [
                'user' => $user
            ]
        );
    }

    public function store()
    {
        $user = session()->get('user');

        $user = User::create([
            'name' => $user['name'],
            'phone' => $user['phone'],
            'password' => Hash::make($user['password']),
            'role_id' => 2,
        ]);

        return redirect()->route('register.success');
    }
}
