<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request)
    {
        $entryId = $request->get('entry_id');
        \Auth::user()->favorite($entryId);
        return back();
    }

    public function destroy(Request $request)
    {
        $entryId = $request->get('entry_id');
        \Auth::user()->favorite($entryId);
        return back();
    }
}
