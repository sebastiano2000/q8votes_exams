<?php

namespace App\Http\Controllers;

use App\Models\UserFav;
use Illuminate\Http\Request;

class UserFavController extends Controller
{
    public function saveList(Request $request)
    {
        return UserFav::saveList($request);
    }
}
