<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\Uid\Uuid;

/**
 * @method static whereIn(string $string, $followings_user_ids)
 * @method static create(array $array)
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function isLikeBy($user_id): bool
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }

    public function isLiked(): bool
    {
        return $this->likes()->where('user_id', $this->id)->exists();
    }
}
