<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PlansController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $packages = Package::all();
            return view('plans.packagelist',compact('packages'))->render();
        }

        return view('plans.index');
    }
}
