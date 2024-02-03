<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class GendersController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        return view('genders.index',compact('genders'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $gender = new Gender();
        $gender->name = $request['name'];
        $gender->slug = Str::slug($request['name']);
        $gender->user_id = $user_id;
        
        $gender->save();
        return redirect(route('genders.index'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|unique:statuses,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $gender = Gender::findOrFail($id);
        $gender->name = $request['name'];
        $gender->slug = Str::slug($request['name']);
        $gender->user_id = $user_id;
        
        $gender->save();
        return redirect(route('genders.index'));
    }

    public function destroy(string $id)
    {
        $gender = Gender::findOrFail($id);
        $gender->delete();
        return redirect()->back();
    }
}
