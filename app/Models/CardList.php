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
        $card_lists = self::where('user_id', $user_id)->orderBy('order')->get();
        $lists = [];
        foreach ($card_lists as $index => $card_list) {
            // カードを追加
            $cards = Card::where('list_id', $card_list->id)->orderBy('order')->get();
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
    public static function createList(string $title, int $user_id, int $order_num) {
        $new_list = new CardList();
        $new_list->list_title = $title;
        $new_list->user_id = $user_id;
        $new_list->order = $order_num;
        $new_list->save();
    }

    public static function updateLists(array $lists, int $user_id) {
        Debugbar::info($lists);
        foreach ($lists as $list_index => $list) {
            // リストにDBのid情報がなかった場合、新規作成
            if(!isset($list['id'])) {
                CardList::createList($list, $user_id, $list_index);
                
            }

            // カードにDBのid情報がなかった場合、新規作成
            foreach ($list['cards'] as $card_index => $card) {
                if(!isset($card['id'])) {
                    Card::createCard($card, $list['id'], $user_id, $card_index);
                }
            }
        }
    }
}
