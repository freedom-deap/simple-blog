<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($userId)
    {
        \Auth::user()->follow($userId);
        return back();
    }
    
    public function destroy($userId)
    {
        \Auth::user()->follow($userId);
        return back();
    }
}
