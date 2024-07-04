<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index() {
        return view('cards.index');
    }

    public function getJson() {
        $lists = Card::getCardsJson(Auth::id());
        return $lists;
    }

    public function changeLists(Request $request) {
        
    }
}
