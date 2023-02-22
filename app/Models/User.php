<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザが投稿した記事の取得
    public function blogEntries()
    {
        return $this->hasMany(BlogEntry::class);
    }

    // ユーザがお気に入り登録しているユーザの取得
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'followed_user_id')->withTimestamps();
    }

    // お気に入り登録されているユーザの取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'followed_user_id', 'user_id')->withTimestamps();
    }

    // お気に入り登録している記事の取得
    public function favorites()
    {
        return $this->belongsToMany(BlogEntry::class, 'favorites', 'user_id', 'entry_id')->withTimestamps();
    }

    // 記事をお気に入り登録しているかの判定
    public function isFavorited($entryId)
    {
        return $this->favorites()->where('entry_id', $entryId)->exists();
    }
    
    // 記事のお気に入り登録/解除
    public function favorite($entryId)
    {
        if($this->isFavorited($entryId))
        {
            $this->favorites()->detach($entryId);
        }
        else
        {
            $this->favorites()->attach($entryId);
        }
    }
    
    public function isFollowed($userId)
    {
        return $this->followings()->where('followed_user_id', $userId)->exists();
    }
    
    //ユーザのお気に入り登録/解除
    public function follow($userId)
    {
        if($this->isFollowed($userId))
        {
            $this->followings()->detach($userId);
        }
        else
        {
            $this->followings()->attach($userId);
        }
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['blogEntries', 'followings', 'favorites']);
    }
}
