<?php

namespace App\Http\Controllers;

use App\Models\UserTest;
use Illuminate\Http\Request;

class UserTestController extends Controller
{
    public function enterResult(Request $request)
    {
        return UserTest::enterResult($request);
    }
}
