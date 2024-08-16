<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPhone;

class StudentPhonesController extends Controller
{
    public function destroy($id){
        $studentphone = StudentPhone::find($id);
        $studentphone->delete();

        session()->flash('info',"Delete");
        return redirect()->back();
    }
}
