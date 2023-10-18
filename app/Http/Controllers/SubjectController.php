<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Auth;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.subject.index', [
                'subjects' => Subject::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Subject $subject)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.subject.upsert', [
                'subject' => $subject,
            ]);
        } else {
            abort(404);
        }
    }

    public function modify(SubjectRequest $request)
    {
        return Subject::upsertInstance($request);
    }

    public function destroy(Subject $subject)
    {
        return $subject->deleteInstance();
    }
}
