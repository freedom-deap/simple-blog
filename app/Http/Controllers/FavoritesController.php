<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($entryId)
    {
        \Auth::user()->favorite($entryId);
        return back();
    }

    public function destroy($entryId)
    {
        \Auth::user()->favorite($entryId);
        return back();
    }
}
