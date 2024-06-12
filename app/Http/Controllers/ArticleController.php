<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $articles = Article::order($request)->load(['user', 'likes', 'tags']);
        $sort_jp = $this->getSortJp($request);

        return view('articles.index', compact('articles', 'sort_jp'));
    }
}
