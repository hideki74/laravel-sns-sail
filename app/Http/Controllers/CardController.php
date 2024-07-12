<?php

namespace App\Http\Controllers;

use App\Models\CardList;
use App\Models\User;
use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    // get
    public function index() {
        return view('cards.index');
    }
    
    // post
    // カードのデータをjsonをstringに変換して返す
    // カードのページを読み込んだとき最初に呼ばれる
    public function initCards(Request $request){
        $card_lists = CardList::where('user_id', $request->user()->id)->get();

        $lists = [];
        foreach ($card_lists as $card_list) {
            $cards = [];
            Card::where('list_id', $card_list->id)->get();
        }
        // $cards = Card::get0rCreateCardsJson($request->user()->id);
        // return $cards;
    }

    // put
    // カードの変更を検知した場合に呼ばれる処理
    public function updateCards(Request $request, Card $card) {
        // $card = Card::where('user_id', $request->user()->id)->get()->first();
        var_dump($request->cards_json);
        // $card->cards_json = $request->cards_json;
        // $card->save();
        return 'saved!';
    }
}
