<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function likes(): BelongsToMany {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function bookmarks(): BelongsToMany {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function isLikedBy(?User $user):bool {
        return $user ? (bool)$this->likes->where('id', $user->id)->count() 
        : false;
    }

    public function isBookmarkedBy(?User $user):bool {
        return $user ? (bool)$this->bookmarks->where('id', $user->id)->count() 
        : false;
    }

    public function getCountLikesAttribute(): int {
        return $this->likes->count();
    }

    public function getCountBookmarksAttribute(): int {
        return $this->bookmarks->count();
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public static function order(?Request $request, ?Collection $collection = null) {
        if(is_null($collection)) $collection = self::get();
        if($request->order === 'asc') {
            $desc = false;
        } else {
            $desc = true;
        }

        return $collection->sortBy($request->sort, SORT_REGULAR, $desc);
    }
}
