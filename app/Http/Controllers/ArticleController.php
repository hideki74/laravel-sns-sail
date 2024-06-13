<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Follow;
use App\Models\Tag;
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

    public function create() {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.create', compact('allTagNames'));
    }

    public function store(ArticleRequest $request, Article $article) {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();

        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index');
    }
}
