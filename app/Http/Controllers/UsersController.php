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
        
        return view('user', [
            'user' => $user,
            'entries' => $user->blogEntries,
            'followings' => $user->followings,
            'favorites' => $user->favorites
        ]);
    }
    
}
