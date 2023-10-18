<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserFav;
use Auth;
use Illuminate\Http\Request;

class UserFavController extends Controller
{
    public function saveList(Request $request)
    {
        return UserFav::saveList($request);
    }

    public function index(Request $request)
    {
        if(!Auth::user()->isAdmin()){
            $questions = UserFav::where('user_id', Auth::user()->id)->pluck('question_id');

            return view('admin.pages.favs.index',[
                'questions' => Question::whereIn('id', $questions)->paginate(50),
            ]);

        }
        else 
            abort(404);
    }
}
