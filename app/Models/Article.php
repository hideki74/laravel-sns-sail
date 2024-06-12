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

    public function user(): BelongsTo {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user):bool {
        return $user ? (bool)$this->likes->where('id', $user->id)->count() 
        : false;
    }

    public function getCountLikesAttribute(): int {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany('App\Tag')->withTimestamps();
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