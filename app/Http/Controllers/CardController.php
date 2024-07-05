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

    public function getJson() {
        $cards = Card::getCardsJson(Auth::id());
        return $cards;
    }

    public function updateCards(Request $request, Card $card) {
        try {
            $user = User::where('id', Auth::id())->get()->first();
            $card = $user->cards;
            $card->cards_json = $request->cards_json;
            $card->user_id = Auth::id();
            $card->update();
            return 'saved';
        } catch(Exception $e) {
            return $e;
        }
    }
}
