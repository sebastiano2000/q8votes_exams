<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard', [
            'subjects' => Subject::all(),
        ]);
    }
}
