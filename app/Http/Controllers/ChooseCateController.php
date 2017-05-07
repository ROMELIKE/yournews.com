<?php

namespace App\Http\Controllers;

use App\Business\CategoryBusiness;
use App\Business\User_CategoryBusiness;
use App\Business\UserBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChooseCateController extends Controller
{
    /**
     * get view choose category,(for the first time user login)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getChooseCate()
    {
        //kiểm tra: nếu user đã có chủ để trong hồ sơ rồi thì -> index,ngược lại show ra form chọn chủ để:
        $id = Session::get('user_id');
        //call to business to check this user choosed category or not:
        $bus = new UserBusiness();
        $result = $bus->checkHaveAnyCategory($id);

        if ($result->messageCode) {
            return redirect()->route('getindex');
        } else {
            //get all category
            $busi = new CategoryBusiness();
            $result = $busi->getAllCateGory()->result;

            //get user info(to show name & avatar)
            $thisUser=$bus->getUserInfo($id)->result;

            return view('user.choosecate', compact(['result','thisUser']));
        }
    }

    public function postChooseCate(Request $request)
    {
        $id = Session::get('user_id');
        $arrayCate = $request->cbCategory;
        //call to bussiness
        $bus = new User_CategoryBusiness();
        $result = $bus->userAddCategory($id, $arrayCate);

        if ($result->messageCode) {
            return redirect()->route('getindex')
                ->with([
                    'flash_level' => 'success',
                    'flash_message' => 'Choose categories successfully !'
                ]);
        } else {
            return redirect()->route('choosecate')
                ->with([
                    'flash_level' => 'warning',
                    'flash_message' => 'Choose categories failure !!'
                ]);
        }
    }
}
