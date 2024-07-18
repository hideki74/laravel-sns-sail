<?php

namespace App\Http\Controllers;

use App\Models\CardList;
use App\Models\User;
use App\Models\Card;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoCardController extends Controller
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
    // 新しいメモカード情報をDBに保存すると同時に取得する
    public function updateCards(Request $request) {
        CardList::updateLists($request->cards_json, $request->user()->id);
        $cards = CardList::loadLists($request->user()->id);
        return json_encode($cards);
    }

    public function createList(Request $request) {
        CardList::createList($request->title, $request->user()->id, $request)
    }

    public function deleteList(Request $request) {
    }

    public function createCard(Request $request) {

    }

    public function deleteCard(Request $request) {
        Debugbar::info($request->listIndex);
        Debugbar::info($request->cardIndex);
        return [$request->listIndex, $request->cardIndex];
    }
}
