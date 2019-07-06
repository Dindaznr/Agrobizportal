<?php

namespace App\Http\Controllers\Auth;

use App\Model\VerifyUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Verify user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail(Request $request, $token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        
        if (isset($verifyUser) ){
            $user = $verifyUser->user;
            $status = "Email Anda berhasil diverifikasi. Anda sekarang dapat login.";
            if (!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = new \DateTime();
                if ($verifyUser->user->customer) {
                    $verifyUser->user->customer->active = 1;
                    $verifyUser->user->customer->save();
                }

                if ($verifyUser->user->seller) {
                    $verifyUser->user->seller->active = 1;
                    $verifyUser->user->seller->save();
                }

                $verifyUser->user->save();
                $status = "Email Anda sudah diverifikasi. Anda sudah dapat login.";
            }
            
            $verifyUser->delete();

            // $this->guard()->login($user); // trigered auto login
            
            return redirect()->route('login')->with('status', $status);
        } else {
            return redirect()->route('login')->with('error', 'Invalid Token');
        }

    }
}
