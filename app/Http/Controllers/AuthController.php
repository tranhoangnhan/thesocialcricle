<?php

namespace App\Http\Controllers;

use App\Models\OTP_Manager;
use App\Models\UsersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function forgot()
    {

        return view('clients.auth.forgotpassword');
    }
    public function reset_password()
    {
        try {
            $type = request()->key;
            if ($type == 'tc' && isset(request()->query()['log'])) { // trường hợp nhập otp
                $param = request()->query()['log'];
                $decode1 = decrypt($param);
                $decode2 = \app\Helpers\Helper::base32_decode($decode1);
                $passwordReset = OTP_Manager::where(['email' => $decode2, 'type' => 'forgotpassword'])->first();
                // dd($passwordReset);
                if (!$passwordReset) {
                    return $this->redirect(route('home'), navigate: true);
                }
            } else {
                // trường hợp nhấn vào link email
                $decoded_key = decrypt(request()->key);
                $decode1 = $decoded_key;
                $decode2 = \app\Helpers\Helper::base32_decode($decode1);
                list($email, $otp, $time) = explode('|', $decode2);
                $user = UsersModel::where('user_email', $email)->first();
                if (!$user) {
                    return $this->redirect(route('home'), navigate: true);
                }
                $passwordReset = OTP_Manager::where(['email' => $email, 'type' => 'forgotpassword'])->first();
                if (!$passwordReset || $passwordReset->token !== $otp || Carbon::now() > $passwordReset->expires_at) {
                    return $this->redirect(route('home'), navigate: true);
                }
            }
            return view('clients.auth.reset_password', compact('decode2'));
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('home'));
        }
    }
}
