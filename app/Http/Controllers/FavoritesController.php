<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request)
    {
        $entryId = $request->get('entry_id');
        $targetEntry = \App\Models\BlogEntry::findOrFail($entryId);
        
        \Auth::user()->favorite($entryId);
        $targetEntry->loadFavoriteUsers();
        header('Content-type: application/json');
        
        return response()->json([
            'isFavorited' => \Auth::user()->isFavorited($entryId),
            'favoritedCount' => $targetEntry->favorited_count
        ]);
    }
}
