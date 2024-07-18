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
    
    // カードを新規作成
    public static function createCard(string $body, int $user_id, int $list_id, int $order_num) {
        $new_card = new Card();
        $new_card->card_body = $body;
        $new_card->user_id = $user_id;
        $new_card->list_id = $list_id;
        $new_card->order = $order_num;
        $new_card->save();
    }
}
