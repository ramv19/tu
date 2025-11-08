<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'search_id',
        'comment',
        'rating',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function search()
    {
        return $this->belongsTo(Search::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    public function isLikedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }
        return $this->likes()->where('user_id', $userId)->exists();
    }
}