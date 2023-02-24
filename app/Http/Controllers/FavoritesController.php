<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request)
    {
        $entryId = $request->get('entry_id');
        \Auth::user()->favorite($entryId);
        header('Content-type: application/json');
        return response()->json([
            'isFavorited' => \Auth::user()->isFavorited($entryId),
        ]);
    }
}
