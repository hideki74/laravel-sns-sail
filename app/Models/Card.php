<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    public function cardList(): BelongsTo {
        return $this->belongsTo(CardList::class);
    }

    // public static function get0rCreateCardsJson($user_id):string {
    //     // データベースにカードデータがあった場合それを取得
    //     if(self::where('user_id', $user_id)->exists()) {
    //         $card = self::where('user_id', $user_id)->get()->first();
    //     } else {
    //         // なかった場合新規作成
    //         $card = new Card();
    //         $card->user_id = $user_id;
    //         $card->cards_json = "[]";
    //         $card->save();
    //     }
    //     return $card->cards_json;
    // }
}
