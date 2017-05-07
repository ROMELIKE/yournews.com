<?php

namespace App\Http\Controllers;

use App\Business\ChangePasswordBusiness;
use App\Business\UserBusiness;
use App\Http\Requests\ChangePasswordRequest;
use Session;
use Hash;

class ChangePasswordController extends Controller
{
    public function postChangePassword(ChangePasswordRequest $request)
    {
        //get data from form view:
        $currentPw = $request->current_pwd;
        $newPw = $request->new_pwd;
        $reNewPw = $request->renew_pwd;
        $id = Session::get('user_id');

        //get 'user password' of this user.
        $bus = new UserBusiness();
        $userPassword = $bus->getUserInfo($id)->result->password;

        //compare the 'current password' vs 'this user password' in database.
        if (Hash::check($currentPw, $userPassword)) {
            //update new password.
            $busi = new ChangePasswordBusiness();
            $newPw = Hash::make($newPw);

            //hàm bị trùng (nhớ sửa trong model user nhé!)
            $result = $busi->changePassword($id, $newPw);
            if ($result->messageCode) {
                $data = [
                    'flash_level' => 'success',
                    'flash_message' => 'Update password successfully!!'
                ];
            }
        } else {
            $data = [
                'flash_level' => 'warning',
                'flash_message' => 'The password not match!'
            ];
        }
        return redirect()->route('getprofile')->with($data);
    }
}
