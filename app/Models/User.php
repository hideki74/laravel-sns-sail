<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }

    public function followers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id')->withTimeStamps();
    }

    public function followings(): BelongsToMany {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function likes(): BelongsToMany {
        return $this->belongsToMany(Article::class, 'likes')->withTimestamps();
    }

    public function isFollowedBy(?User $user): bool {
        return $user ? (bool)$this->followers->where('id', $user->id)->count() : false;
    }

    public function getCountFollowersAttribute(): int {
        return $this->followers->count();
    }

    public function getCountFollowingsAttribute(): int {
        return $this->followings->count();
    }

    public function getCountArticlesAttribute(): int {
        return $this->articles->count();
    }

    public function getCountLikesAttribute(): int {
        return $this->likes->count();
    }

    public function getCountGetLikesAttribute(): int {
        $liked_cnt = 0;
        foreach ($this->articles as $article) {
            $liked_cnt += $article->likes->count();
        }
        return $liked_cnt;
    }
}
