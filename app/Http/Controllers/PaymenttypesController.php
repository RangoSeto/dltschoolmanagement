<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paymenttype;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class PaymenttypesController extends Controller
{
    
    public function index()
    {
        $paymenttypes = Paymenttype::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('paymenttypes.index',compact('paymenttypes','statuses'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:50|unique:paymenttypes',
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            $paymenttype = new Paymenttype();
            $paymenttype->name = $request['name'];
            $paymenttype->slug = Str::slug($request['name']);
            $paymenttype->status_id = $request['status_id'];
            $paymenttype->user_id = $user_id;

            $paymenttype->save();

            if($paymenttype){
                return response()->json(["status"=>"success","data"=>$paymenttype]);
            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

        
        return redirect(route('paymenttypes.index'));
    }


    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'name' => ['required','max:50','unique:paymenttypes,name,'.$id],
            'status_id' => ['required','in:3,4']
        ]);
        
        $user = Auth::user();
        $user_id = $user['id'];

        try{
            $paymenttype = Paymenttype::findOrFail($id);
            $paymenttype->name = $request['name'];
            $paymenttype->slug = Str::slug($request['name']);
            $paymenttype->status_id = $request['status_id'];
            $paymenttype->user_id = $user_id;

            $paymenttype->save();

            if($paymenttype){
                return response()->json(["status"=>"success","data"=>$paymenttype]);
            }

            return response()->json(["status"=>"failed","message"=>"Failed to update Payment Method."]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

        
    }

    // public function destroy(string $id)
    // {
    //     $paymenttype = Paymenttype::findOrFail($id);
    //     $paymenttype->delete();

    //     session()->flash('info','Delete Successfully');
    //     return redirect()->back();
    // }


    
    public function destroy(Paymenttype $paymenttype)
    {

        try{

            if($paymenttype){
                $paymenttype->delete();
                return response()->json(["status"=>"success","data"=>$paymenttype,"message"=>"Delete Successfully"]);
            }

            return response()->json(["status"=>"failed","message"=>"No Data Found"]);

        }catch(Exception $e){
            Log::error($e->getMessage()); // ဒါမထည့်လည်းရတယ် logထဲမှာသွားရေးခိုင်းလိုက်တာ
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }

    public function typestatus(Request $request){
        $paymenttype = Paymenttype::findOrFail($request['id']);
        $paymenttype->status_id = $request['status_id'];
        $paymenttype->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Paymenttype::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
