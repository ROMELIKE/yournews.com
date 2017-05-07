<?php

namespace App\Http\Controllers\Auth;

use App\Business\ForgotPasswordBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use DB;
use Hash;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getForgot()
    {
        return view('user.forgotpassword');
    }

    public function postForgot(ForgotPasswordRequest $request)
    {
        $email = $request->fg_email;
        $phone = $request->fg_phone;

        //check: compare input data <--> database data:
        $array = ['email' => $email, 'phone' => $phone];
        $bus = new ForgotPasswordBusiness();
        $result = $bus->checkEmailPhoneNumber($array)->messageCode;

        if ($result) {
            $confirmCode = str_random(32);
            //save $confirmCode to database:
            $sql = DB::table('user')->where('email', $email)
                ->where('sdt', $phone)->update(['active' => $confirmCode]);

            //send the email to user to confirm forgot password request:
            $data = [
                'phone' => $request->fg_phone,
                'email' => $request->fg_email,
                'code' => $confirmCode
            ];

            try {
                $mail = Mail::send('email.ForgotPassword', $data,
                    function ($msg) {
                        $msg->from('thetung.pdca@gmail.com',
                            'Yournews Support System');
                        $msg->to(Input::get('fg_email'), 'admin')
                            ->subject('Confirm password forgeting request');
                    });
                echo "<script>alert('We just sent to you a message, confirm now'); window.location='"
                    .url('forgot')."';</script>";
            } catch (\Exception $ex) {
                echo "<script>alert('Sorry, but you could not send this Email!'); window.location='"
                    .url('forgot')."';</script>";
            }
        } else {
            //redirect to forgot password page and give message
            return redirect()->route('getforgot')->with([
                'flash_level' => 'warning',
                'flash_message' => 'Sorry,we dont find any email or phonenumber like this! try again!'
            ]);
        }
    }
}
