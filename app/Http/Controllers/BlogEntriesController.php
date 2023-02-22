<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogEntry;

class BlogEntriesController extends Controller
{
   /**
    *ダッシュボードを表示
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function index()
    {
        $entries = BlogEntry::paginate(10);
        
        foreach($entries as $entry)
        {
            $entry->loadFavoriteUsers();
        }
        
        return view('dashboard', [
            'entries' => $entries
        ]);
    }
    
    // 記事の閲覧画面を表示
    public function show($entryId)
    {
        return view('entries.show', [
            'entry' => BlogEntry::findOrFail($entryId)
        ]);
    }
    
   /**
    *新規作成画面を表示
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('entries.create');
    }
    
    /**
    *新規作成のブログを保存
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required'
        ]);
        $attributes = $request->only(['title', 'content']);
        $request->user()->blogEntries()->create($attributes);
        
        return redirect('/');
    }
    
    /**
    *記事の編集画面を表示
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function edit($entryId)
    {
        $entry = BlogEntry::findOrFail($entryId);
        if(\Auth::id() === $entry->user_id)
        {
            return view('entries.edit', [
                'entry' => $entry
            ]);
        }
        return redirect('/');
    }
    
    /**
    *ブログの内容を更新
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required'
        ]);
        $targetEntry  = BlogEntry::findOrFail($request->get('entry_id'));
        if(\Auth::id() === $targetEntry->user_id)
        {
            $targetEntry->title = $request->get('title');
            $targetEntry->content = $request->get('content');
            $targetEntry->save();
        }
        
        return redirect('/');
    }
    
    /**
    *記事の削除
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function destroy($entryId)
    {
        $targetEntry  = BlogEntry::findOrFail($entryId);
        if(\Auth::id() === $targetEntry->user_id)
        {
            $targetEntry->delete();
        }
        return redirect('/');
    }
}
