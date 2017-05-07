<?php

namespace App\Http\Controllers\Auth;

use App\Business\LoginBusiness;
use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use DB;
use Session;
use DateTime;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        if (Session::has('username') && Session::has('user_id')) {
            return redirect()->route('getindex');
        } else {
            return view('user.login');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember; //'on' hoặc null
        $token = $request->_token;

        $bus = new LoginBusiness();
        $checkUsername = $bus->checkUsername($username);
        //nếu tồn tại user đó.
        if ($checkUsername->messageCode) {
            //nếu user đó password đúng:
            if (Hash::check($password, $checkUsername->result->password)) {

                if ($remember) {
                    //nếu đã nhấn remember thì ,lưu token vào CSDL,tạo session set thời gian:

                } else {
                    //nếu chưa nhấn thì chỉ tạo ra session:

                }
                Session::put('username', $checkUsername->result->username);
                Session::put('user_id', $checkUsername->result->user_id);

                /*lưu thời gian đăng nhập vào CSDL:
                */
                $id = Session::get('user_id');
                $array = ['last_login' => new DateTime()];
                $result = $bus->updateUser($id, $array);

                return redirect()->route('getindex')->with([
                    'flash_level' => 'success',
                    'flash_message' => 'Welcome back, '.Session::get('username')
                ]);
            }else{
                return view('user.login',['messageLogin'=>'Password do not match for this user, try again.']);
            }
        }else{
            return view('user.login',['messageLogin'=>$checkUsername->message]);
        }
        return view('user.login',['messageLogin'=>'Sorry,some things went wrong! can not login']);
    }

//    public function postLogin(LoginRequest $request)
//    {
//
//        $login = [
//            'username' => $request->username,
//            'password' => $request->password
//        ];
//        if (Auth::attempt($login)) {
//            return redirect()->route('profile')->with([
//                'flash_level' => 'success',
//                'flash_message' => 'Chào mừng bạn đăng nhập thành công'
//            ]);
//        } else {
//            return redirect()->route('getlogin')->with([
//                'flash_level' => 'danger',
//                'flash_massage' => 'Username hoặc Password không đúng!'
//            ]);
//        }
//    }

    public function getLogout()
    {
        Session::forget(['username', 'user_id']);

        return redirect()->route('getlogin');
    }
}
