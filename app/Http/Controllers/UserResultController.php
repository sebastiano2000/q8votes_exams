<?php

namespace App\Http\Controllers;

use App\Models\UserResult;
use Illuminate\Http\Request;

class UserResultController extends Controller
{
    public function enterResult(Request $request)
    {
        return UserResult::enterResult($request);
    }
}
