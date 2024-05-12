<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsLikeController extends Controller
{
    public function like(Post $post){

        $user = Auth::user();

        $user->likes()->attach($post);

        session()->flash('success','You liked this post');
        return redirect()->back();
    }

    public function unlike(Post $post){
        $user = auth()->user();

        $user->likes()->detach($post);

        session()->flash('success','You unliked this post');
        return redirect()->back();
    }
}
