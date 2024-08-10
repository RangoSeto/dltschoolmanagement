<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use App\Notifications\OtpEmailNotify;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;
use App\Jobs\OtpMailJob;

class OtpService{

    public function generateotp($userid){

        $randomotp = rand(100000,999999);
        $expireset = Carbon::now()->addMinute(1);
        $user = Auth::user();
        $user_email = $user->email;

        Otp::create([
            'user_id'=>$userid,
            'otp'=>$randomotp,
            'expires_at'=>$expireset
        ]);

        // Send OTP via to email

        // send Email Notification OTP code 
        // $user = User::where('id',$userid)->get();
        // $data = [
        //     "otp"=>$randomotp
        // ];
        // Notification::send($user,new OtpEmailNotify($data));

        // Send OTP via to mail with job 
        dispatch(new OtpMailJob($user_email,$randomotp));

        return $randomotp;
    }

    public function verifyotp($userid,$otp){

        $checkotp = Otp::where('user_id',$userid)
                    ->where('otp',$otp)
                    ->where('expires_at','>',\Carbon\Carbon::now())->first();

        if($checkotp){
            // OTP Valid

            $checkotp->delete(); // Delete OTP after verification

            return true;

        }else{
            // OTP Invalid

            return false;
        }
    }

}

?>
