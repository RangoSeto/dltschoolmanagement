<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersFollowerController extends Controller
{
    public function follow(User $user){
        $curloginuser = Auth::user();
        $curloginuser->followings()->attach($user);

        session()->flash('success','Followed Successfully');
        return redirect()->back();
    }

    public function unfollow(User $user){
        $curloginuser = auth()->user();
        $curloginuser->followings()->detach($user);

        session()->flash('success','UnFollowed Successfully');
        return redirect()->back();
    }
}
