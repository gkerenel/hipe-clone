<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;


/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $username)
 * @method static inRandomOrder()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
    ];

    public function posts() : Collection
    {
        $followings_user_ids = $this->followings()->pluck('following_id');
        return Post::whereIn('user_id', $followings_user_ids)
            ->orWhere('user_id', $this->id)
            ->orderBy('created_at', 'desc');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'following_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'follower_id');
    }

    public function isFollowing(User $user): bool
    {
        return $this->followings()->where('follower_id', $user->id)->exists();
    }
}
