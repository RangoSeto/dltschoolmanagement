<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class WarehousesController extends Controller
{
    
    public function index()
    {
        $warehouses = Warehouse::paginate(5); // ဒီက paginate count ကိုယူမသံုးပေမယ် ဒါပါမှ view ထဲက link ကအလုပ်ဖြစ်မှာ
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('warehouses.index',compact('warehouses','statuses'));
    }


    public function edit(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        
        return response()->json($warehouse);
    }




    public function fetchalldatas()
    {
        try{
            $warehouses = Warehouse::all();
            return response()->json(['status'=>"success","data"=>$warehouses]);
        }catch(Exception $e){
            Log::error($e->getMessage()); 
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }




    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Warehouse::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
