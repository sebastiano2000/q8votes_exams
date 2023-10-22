<?php

namespace App\Http\Controllers;

use App\Models\Preparator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreparatorController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.preparator.index',[
                'preparators' => Preparator::filter($request->all())->paginate(10),
        
            ]);
        else 
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upsert(Preparator $preparator)
    {
        if(Auth::user()->isAdmin())
            return view('admin.pages.preparator.upsert',[
                'preparator' => $preparator,
            ]);
        else 
            abort(404);
    }

    public function modify(Request $request)
    {
        return Preparator::upsertInstance($request);
    }

    public function destroy(Preparator $preparator)
    {
        return $preparator->deleteInstance();
    }

    public function filter(Request $request)
    {
        if(Auth::user()->isSuperAdmin())
            return view('admin.pages.preparator.index',[
                'preparators' => Preparator::filter($request->all())->paginate(10)
            ]);
        else 
            abort(404);
    }
}
