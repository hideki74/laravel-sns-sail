<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index() {
        return view('cards.index');
    }
    
    // カードのデータをjsonをstringに変換して返す
    // カードのページを読み込んだとき最初に呼ばれる
    public function initCards(Request $request):string {
        $cards = Card::getCardsJson($request->user()->id);
        return $cards;
    }

    // カードの変更を検知した場合に呼ばれる処理
    public function updateCards(Request $request, Card $card) {
        $card = Card::where('user_id', $request->user()->id)->get()->first();
        $card->cards_json = $request->cards_json;
        $card->save();
        return 'saved!';
    }
}
