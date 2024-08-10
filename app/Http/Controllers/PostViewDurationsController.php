<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PostViewDuration;


class PostViewDurationsController extends Controller
{
    public function trackduration(Request $request){

        // need to cunvert laravel timing format for to get time diff
        // $entrytime = Session::get('entrytime');
        // $exittime = $request->input('exittime');

        $entrytime = Carbon::parse(Session::get('entrytime'));
        $exittime = Carbon::parse($request->input('exittime'));
        $postid = Session::get('post_id')->id;
        $user_id = Auth::id();

        if($entrytime && $exittime && $postid && $user_id){

            $durationseconds = $entrytime->diffInSeconds($exittime);
            // $durationminute = $entrytime->diffInMinutes($exittime);

            $postviewduration = new PostViewDuration();
            $postviewduration->user_id = $user_id;
            $postviewduration->post_id = $postid;
            $postviewduration->duration = $durationseconds;
            $postviewduration->save();

            // Clear Session Variables 
            Session::forget('entrytime');
            Session::forget('post_id');

        }

        // return response()->json(["status"=>"success","entrytime"=>$entrytime,"exittime"=>$exittime,"postid"=>$postid,"duration"=>$durationseconds]);
        return response()->json(["status"=>"success"]);


    }
}
