<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'news_id',
        'parent_id',
    ];


    public function news()
    {
        return $this->belongsTo(News::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

}
