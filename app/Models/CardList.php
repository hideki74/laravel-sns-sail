<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardList extends Model
{
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function card(): HasMany {
        return $this->hasMany(Card::class);
    }

    public static function createCardJson(int $user_id): string {
        $card_lists = self::where('user_id', $user_id)->get();
        $lists = [];
        foreach ($card_lists as $index => $card_list) {
            // カードを追加
            $cards = Card::where('list_id', $card_list->id)->get();
            $cards_array = [];
            foreach ($cards as $card_index => $card) {
                $cards_array += [$card_index => ['body' => $card->card_body]];
            }

            // lists配列にタイトルとカードを追加
            $lists += [$index => [
                'cards' => $cards_array,
                'title' => $card_list->list_title,
            ]]; 
        }

        // lists配列をjsonに変換
        $card_json = json_encode($lists);
        return $card_json;
    }
}
