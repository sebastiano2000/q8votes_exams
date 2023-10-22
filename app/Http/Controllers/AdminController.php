<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Preparator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard', [
            'subjects' => Subject::all(),
            'preparators' => Preparator::all(),
        ]);
    }
}
