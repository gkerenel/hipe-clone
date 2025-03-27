<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;


/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $username)
 * @method static inRandomOrder()
 * @property mixed $id
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
    ];

    protected $appends = ['is_followed'];

    public function getIsFollowedAttribute(): bool
    {
        return Auth::user() && $this->isFollowed(Auth::user());
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
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
        return $this->followings()->where('following_id', $user->id)->exists();
    }

    public function isFollowed($user): bool
    {
        return $this->followings()->where('follower_id', $user->id)->exists();
    }
}
