<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPoint;
use App\Models\User;
use App\Models\PointsTransfer;
use App\Models\PointTransferHistory;

class PointTransfersController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $pointtransferhistories = PointTransferHistory::all();
            
            return view('pointtransfers.list',compact('pointtransferhistories'))->render();
        }

        return view('pointtransfers.index');

    }

    public function transfers(Request $request){

        $request->validate([
            'receiver_id'=>'required|exists:users,id',
            'points'=>'required|integer|min:1'
        ]);

        $sender = Auth::user();
        $receiver = User::find($request->input('receiver_id'));
        $points = $request->input('points');

        // Ensure that sender to sender are not the same
        if($sender->id === $receiver->id){
            return response()->json(['message'=>'You cannot transfer points to yourself.'],400);
        }

        if($sender->userpoints->points < $points){
            return response()->json(['message'=>'Insufficient points.'],400);
        }

        // Begin a databse transition
        \DB::beginTransaction();

        try{

            // Deduct points from sender
            $sender->userpoints->points -= $points;
            $sender->userpoints->save();

            // Add points from receiver
            $receiver->userpoints->points += $points;
            $receiver->userpoints->save();


            // Point Transition Record
            PointsTransfer::create([
                'sender_id'=>$sender->id,
                'receiver_id'=>$receiver->id,
                'points'=>$points
            ]);
            

            // Commit the transaction 
            \DB::commit();


            return response()->json(["message"=>"Points transferred successfully"]);
        }catch(\Exception $err){

            // Rollback the transaction in case of error occur
            // \DB::rollBack(); // i don't know it's wrong or not 
            \DB::rollback();

            return response()->json(["message"=>$err->getMessage()],400); 
        }

    }

}
// $user->userpoints->create([]);