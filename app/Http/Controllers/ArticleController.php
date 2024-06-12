<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $articles = Article::order($request)->load(['user', 'likes', 'tags']);
        $sort_jp = $this->getSortJp($request);

        return view('articles.index', compact('articles', 'sort_jp'));
    }

    public function following(Request $request) {
        $following_ids = Follow::followingIDs(Auth::id());
        $articles = Article::whereIn('user_id', $following_ids)->get()->load(['user', 'likes', 'tags']);
        $articles = Article::order($request, $articles);
        $sort_jp = $this->getSortJp($request);

        return view('articles.following', compact('articles', 'sort_jp'));
    }
}
