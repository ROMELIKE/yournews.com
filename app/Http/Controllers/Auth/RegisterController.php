<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Input;
use App\Business;
use DateTime;
use DB;
use Mail;
use Hash;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function postRegister(RegisterRequest $request)
    {
        $user = array(
            'username' => $request->rusername,
            'password' => Hash::make($request->rpassword),
            'email' => $request->remail,
            'sdt' => $request->rphone,
            'status'=>0,
            'create_at' => new DateTime()
        );

        $bus = new Business\RegisterBusiness();
        $addUser = $bus->postRegister($user);
        //mở rộng check tiếp bằng mail:

        if ($addUser->messageCode) {

            $activeCode = str_random(32);

            //save $activeCode to database:
            $sql = DB::table('user')->where('username', $request->rusername)
                ->update(['active' => $activeCode]);

            $data = [
                'username' => $request->rusername,
                'code' => $activeCode
            ];

            try {
                $mail = Mail::send('email.Active', $data, function ($msg) {
                    $msg->from('thetung.pdca@gmail.com', 'Yournews system');
                    $msg->to(Input::get('remail'), 'admin')
                        ->subject('New message to Manager!');
                });
                echo "<script>alert('Go to your mail, and active your new account'); window.location='"
                    .url('index')."';</script>";
            } catch (\Exception $ex) {
                echo "<script>alert('Sorry, but we could not send this Email!'); window.location='"
                    .url('login')."';</script>";
            }

            return redirect()->route('getlogin')->with([
                'flash_level' => 'warning',
                'flash_massage' => $addUser->message.' active your account'
            ]);
        }

        return $addUser->message;
    }

    public function getActive(Request $request)
    {
        $username = $request->username;
        $active = $request->code;
        $sql = DB::table('user')->where('username', $username)
            ->where('active', $active)
            ->update(['status' => 1]);
        if ($sql) {
            return redirect()->route('getindex')->with([
                'flash_level' => 'success',
                'flash_message' => 'Your account was actived successfully!!'
            ]);
        } else {
            return redirect()->route('getindex')->with([
                'flash_level' => 'warning',
                'flash_message' => 'Your account could not be active!!'
            ]);
        }
    }
}
