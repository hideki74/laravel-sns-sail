<?php

namespace App\Http\Controllers;

use App\Models\CardList;
use App\Models\User;
use App\Models\Card;
use Barryvdh\Debugbar\Facades\Debugbar;
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
    // カードのデータをDBから読み込み、配列をjsonにして返す
    // カードのページを読み込んだとき最初に呼ばれる
    public function initCards(Request $request){
        $cards = CardList::loadLists($request->user()->id);
        return json_encode($cards);
    }

    // put
    // カードの変更を検知した場合に呼ばれる処理
    public function updateCards(Request $request) {
        CardList::updateLists($request->user()->id, $request->cards_json);
        return 'saved!';
    }
}
