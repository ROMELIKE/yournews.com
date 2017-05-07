<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use Hash;
use Illuminate\Support\Facades\Input;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getNewPass(Request $request)
    {
        $email = $request->email;
        $confirm = $request->code;
        $phone = $request->phone;

        //creating a new password:
        $newUserPassword = str_random(32);

        $newDBPassword = Hash::make($newUserPassword);
        //save new password:
            $sql = DB::table('user')->where('email', $email)->where('sdt', $phone)
                ->where('active', $confirm)->update(['password' => $newDBPassword]);
        if(!$sql){
            echo "<script>alert('Sorry!, we can not change your password!'); window.location='"
                .url('login')."';</script>";
        }else{
            $data = [
                'newpass' => $newUserPassword
            ];

            try {
                $mail = Mail::send('email.GetNewPassword', $data,
                    function ($msg) use ($email) {
                        $msg->from('thetung.pdca@gmail.com', 'Yournews system');
                        $msg->to($email)->subject('New password');
                    });

                echo "<script>alert('Your password was change, check your mail to take new password'); window.location='"
                    .url('login')."';</script>";
            } catch (\Exception $ex) {
                echo "<script>alert('We could not send message to you.'); window.location='"
                    .url('forgot')."';</script>";
            }
        }

    }
}
