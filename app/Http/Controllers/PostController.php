<?php

namespace App\Http\Controllers;

use App\Business\PostBusiness;
use App\Business\UserBusiness;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    public function getPost(Request $request)
    {
        $uId = Session::get('user_id');
        $id = $request->id;
        $bus = new PostBusiness();
        $post = $bus->getPostByPostId($id)->result;

        //lấy thisUser để hiển thị: tên & avatar ở view mới.
        $userBus = new UserBusiness();
        $thisUser = $userBus->getUserInfo($uId)->result;

        return view('user.single', compact(['post', 'thisUser']));
    }


}
