<?php 

namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Carbon;

class OtpService{

    public function generateotp($userid){

        $randomotp = rand(100000,999999);
        $expiresat = Carbon::now()->addMinute(10);

        Otp::create([
            'user_id'=>$userid,
            'otp'=>$randomotp,
            'expires_at'=>$expiresat
        ]);

        // Send OTP via to email 

        return $randomotp;
    }

    public function verifyotp($userid,$opt){

        $checkotp = Otp::where('user_id',$userid)
                    ->where('otp',$opt)
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