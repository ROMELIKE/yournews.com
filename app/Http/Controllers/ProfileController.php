<?php

namespace App\Http\Controllers;

use App\Business\ProfileBusiness;
use App\Business\UserBusiness;
use App\Business\User_CategoryBusiness;
use App\Http\Requests\ProfileRequest;
use File;
use Illuminate\Http\Request;
use Session;
use DB;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getProfile()
    {
        //kiểm tra nếu user đã đăng nhập hay chưa?
        if (Session::has(['username', 'user_id'])) {
            $id = Session::get('user_id');
            //lấy: thông tin user
            $busi = new UserBusiness();
            //lấy: thông tin user :
            $thisUser = $busi->getUserInfo($id)->result;
            //kiểm tra: user đã active tài khoản hay chưa?
            if ($thisUser->status) {
                $bus = new UserBusiness();
                $data = $bus->checkHaveAnyCategory($id);
                if ($data->messageCode) {

                    //lấy ra dữ liệu của người dùng này:
                    $busi = new UserBusiness();
                    $result = $busi->getUserInfo($id)->result;

                    //lấy ra list các chủ đề user đó đã chọn:
                    $busin = new User_CategoryBusiness();
                    $choosedCate = $busin->getCategoryByUserId($id)->result;

                    //lấy ra list các chủ đề user đó không chọn:
                    $busin = new User_CategoryBusiness();
                    $unChoosedCate
                        = $busin->getCategoryUserNotChoose($id)->result;

                    return view('user.profile',
                        compact(['result', 'choosedCate', 'unChoosedCate','thisUser']));
                } else {
                    return redirect()->route('getchoosecate');
                }
            } else {
                //nếu chưa active tk: chuyển về trang chủ unactive, ko cho làm gì cả!
                return view('user.indexUnActive');
            }
        } else {
            return redirect()->route('getlogin');
        }
    }

    public function postProfile(ProfileRequest $request)
    {
        //lưu thông tin cá nhân:

        $id = Session::get('user_id');
        //thiết đặt: cập nhât thông tin cá nhân:

        //nếu user đã nhập ảnh mới thì lấy ảnh đó ra xử lý, còn khong thì vẫn để ảnh cũ
        if(isset($request->avatar)&&$request->avatar){
            $avatar=$request->avatar->getClientOriginalName();
            //chuyển ảnh mới, vào thư mục:
            $request->avatar->move('yournews/images/user/',$request->avatar->getClientOriginalName());

            //lấy ra ảnh cũ(để xóa)
            $current_avatar='yournews/images/user/'.$request->current_avatar;
            //xóa ảnh cũ đi trong thư mục:
            if(File::exists($current_avatar)){
                File::delete($current_avatar);
            }
        }else{
            $avatar=$request->current_avatar;
        }
        $data = [
            'email' => $request->email,
            'sex' => $request->gender,
            'sdt' => $request->phone,
            'avatar'=>$avatar
        ];

        $bus = new ProfileBusiness();
        $result1 = $bus->UpdateUserInfo($id, $data);

        //sử lý: category cho user:
        $data2 = $request->cbCategory;
        $bus = new ProfileBusiness();
        $result2 = $bus->UpdateUserCategory($id, $data2);

        //nếu: cả 2 cập nhật thành công!
        if (($result1->messageCode) && ($result2->messageCode)) {
            return redirect()->route('getprofile')->with([
                'flash_level' => 'success',
                'flash_message' => 'Update user profile, successfully!'
            ]);
        } else {
            return redirect()->route('getprofile')->with([
                'flash_level' => 'warning',
                'flash_message' => 'Update user profile, failure. Try again!'
            ]);
        }
    }
}

