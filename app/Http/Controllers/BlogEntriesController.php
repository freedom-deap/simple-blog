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
        $entries = BlogEntry::all();
        
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
        $targetEntry  = BlogEntry::findOrFail($request->get('entry_id'));
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
        return view('entries.edit', [
            'entry' => BlogEntry::findOrFail($entryId)
        ]);
    }
    
    /**
    *ブログの内容を更新
    * 
    * 
    * @return \Illuminate\View\View
    */
    public function update($entryId)
    {
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
        return redirect('/');
    }
}
