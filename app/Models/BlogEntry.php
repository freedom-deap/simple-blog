<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogEntry extends Model
{
    use HasFactory;
    
    // ユーザの入力の値を保存するカラムの指定
    protected $fillable = [
        'title',
        'content'
    ];
    
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d');
    // }
    
    
    // 記事を投稿したユーザの取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // お気に入り登録しているユーザの取得
    public function favorited()
    {
        return $this->belongsToMany(User::class, 'favorites', 'entry_id', 'user_id')->withTimestamps();   
    }
    
    public function loadFavoriteUsers()
    {
        return $this->loadCount('favorited');
    }
    
    
}
