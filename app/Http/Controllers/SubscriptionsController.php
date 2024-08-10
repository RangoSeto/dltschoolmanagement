<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function subscribe(Request $request){

    }

    public function expired(){
        return view('subscriptions.expired');
    }
}
