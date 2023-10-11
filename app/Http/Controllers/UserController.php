<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequest2;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.user.index',[
                'users' => User::filter($request->all())->paginate(50),
            ]);
        else 
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(User $user)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.user.upsert',[
                'user' => $user,
            ]);
        else 
            abort(404);
    }

    public function reset()
    {
        return view('auth.password-reset-user');
    }

    public function status(Request $request)
    {
        return User::statusUpdate($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function modify(UserRequest $request)
    {
        return User::upsertInstance($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->deleteInstance();
    }

    public function filter(Request $request)
    {
        return view('admin.pages.user.index',[
            'users' => User::filter($request->all())->paginate(50)
        ]);
    }
}
