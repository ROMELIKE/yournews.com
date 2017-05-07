<?php

namespace App\Http\Controllers;

use App\Business\Post_CategoryBusiness;
use App\Business\TestBusiness;
use App\Business\User_CategoryBusiness;
use App\Business\UserBusiness;
use DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getIndex()
    {
        //kiểm tra: user đã đăng nhập hay chưa?
        if (Session::has(['username', 'user_id'])) {
            $id = Session::get('user_id');
            $bus = new UserBusiness();
            //lấy: thông tin user :
            $thisUser = $bus->getUserInfo($id)->result;

            //kiểm tra: user đã active account ?
            if ($thisUser->status) {
                //kiểm tra user đó , đã chọn chuyên mục chưa
                $data = $bus->checkHaveAnyCategory($id);
                $busi = new Post_CategoryBusiness();

                if ($data->messageCode) {
                    //nếu đã chọn chủ đề. lấy ra những bài viết thuộc chuyên mục mà người dùng này đã chọn:
                    $result = $busi->getIndex($id);
                    $posts = $result->result;
                } else {
                    //nếu chưa chọn chủ đề .lấy ra những bài viết thuộc chuyên mục mà người dùng này đã chọn:
                    $result = $busi->getIndexDefault();
                    $posts = $result->result;
                }
                //lấy ra list các chủ đề user đó đã chọn(cho lên phần lọc):
                $busin = new User_CategoryBusiness();
                $choosedCate = $busin->getCategoryByUserId($id)->result;

                return view('user.index',
                    compact(['posts', 'choosedCate', 'thisUser']));
            } else {
                return view('user.indexUnActive');
            }
        } else {
            return redirect()->route('getlogin');
        }
    }
}
