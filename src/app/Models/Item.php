<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condition;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'description',
        'category_id',
        'condition_id',
        'is_sold',
        'brand',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // いいねしたユーザー
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    // いいね数用
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function scopeDetail($query)
    {
        return $query
            ->with([
                'comments.user.profile',
                'categories',
                'condition',
                ])
            ->withCount([
                'comments',
                'likes',
                ])
            ->with([
                'likes' => function ($query) {
                    if (auth()->check()) {
                        $query->where('user_id', auth()->id());
                    }
                }
            ]);
    }
}
