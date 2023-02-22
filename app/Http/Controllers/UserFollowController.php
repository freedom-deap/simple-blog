<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store(Request $request)
    {
        \Auth::user()->follow($request->get('user_id'));
        return back();
    }
    
    public function destroy(Request $request)
    {
        \Auth::user()->follow($request->get('user_id'));
        return back();
    }
}
