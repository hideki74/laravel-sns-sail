<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public static function followingIDs(int $auth_user_id) {
        $followings = self::where('follower_id', $auth_user_id)->get()->toArray();
        $following_ids = [];
        foreach ($followings as $following) {
            array_push($following_ids, $following['followee_id']);
        }

        return $following_ids;
    }
}
