<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // ユーザ詳細画面の表示
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $user->loadRelationshipCounts();
        
        return view('user', [
            'user' => $user,
            'entries' => $user->blogEntries()->paginate(100),
            'followings' => $user->followings()->paginate(100),
            'favorites' => $user->favorites()->paginate(100)
        ]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $user = User::findOrFail($request->get('user_id'));
        
        if(\Auth::id() !== $user->id)
        {
            return redirect('/');
        }
        
        $user->name = $request->get('name');
        $user->profile_txt = $request->get('profile_txt');
        
        $user->save();
        
        return back();
    }
    
}
