<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name, Request $request) {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles;
        $articles = Article::order($request, $articles);
        $sort_jp = $this->getSortJp($request);

        return view('users.show', compact('user', 'articles', 'sort_jp'));
    }

    public function likes(string $name, Request $request) {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);
        $articles = $user->likes;
        $articles = Article::order($request, $articles);
        $sort_jp = $this->getSortJp($request);

        return view('users.likes', compact('user', 'articles', 'sort_jp'));
    }

    public function follow(Request $request, string $name) {
        $user = User::where('name', $name)->first();

        if($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name) {
        $user = User::where('name', $name)->first();

        if($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    public function followings(string $name) {
        $user = User::where('name', $name)->first();
        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', compact('user', 'followings'));
    }

    public function followers(string $name) {
        $user = User::where('name', $name)->first()->load('followings.followers');;
        $followers = $user->followers->sortByDesc('created_at') ->load('followers.followers');;

        return view('users.followers', compact('user', 'followers'));
    }
}
