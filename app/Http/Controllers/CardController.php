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
            $user = Card::getUser(Auth::id());
            $user->cards_json = $request;
            $card->save();
            return 'saved!';
        } catch(Exception $e) {
            return $e;
        }
    }
}
