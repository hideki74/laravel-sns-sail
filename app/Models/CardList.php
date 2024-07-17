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

    // メモカードの情報をDBから読み込み、配列を戻り値として返す
    public static function loadLists(int $user_id): array {
        $card_lists = self::where('user_id', $user_id)->get();
        $lists = [];
        foreach ($card_lists as $index => $card_list) {
            // カードを追加
            $cards = Card::where('list_id', $card_list->id)->get();
            $cards_array = [];
            foreach ($cards as $card_index => $card) {
                $cards_array += [$card_index => [
                    'id' => $card->id,
                    'body' => $card->card_body
                ]];
            }

            // lists配列にタイトルとカードを追加
            $lists += [$index => [
                'cards' => $cards_array,
                'id' => $card_list->id,
                'title' => $card_list->list_title,
            ]]; 
        }

        return $lists;
    }

    // カードリストを新規作成
    public static function createList(int $user_id, array $list) {
        $new_list = new CardList();
        $new_list->list_title = $list['title'];
        $new_list->user_id = $user_id;
        $new_list->save();
    }

    public static function updateLists(int $user_id, array $lists) {
        foreach ($lists as $list) {
            // リストにDBのid情報がなかった場合、新規作成
            if(!isset($list['id'])) {
                CardList::createList($user_id, $list);
            }

            // カードにDBのid情報がなかった場合、新規作成
            foreach ($list['cards'] as $card) {
                if(!isset($card['id'])) {
                    Card::createCard($list['id'], $card);
                }
            }
        }
    }
}
