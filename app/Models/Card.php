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
    public static function createCard(int $list_id, array $card) {
        $new_card = new Card();
        $new_card->card_body = $card['body'];
        $new_card->list_id = $list_id;
        $new_card->save();
    }
}
