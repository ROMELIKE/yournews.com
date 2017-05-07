<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/24/2017
 * Time: 4:10 PM
 */

namespace App\Business;


use App\Models\User;
use App\Models\User_Category;

class ProfileBusiness
{
    public function UpdateUserInfo($id,$data)
    {
        $model=new User();
        return $model->updateUserInfo($id,$data);
    }

    public function UpdateUserCategory($id,$data)
    {
        $model=new User_Category();
        return $model->updateUserCategory($id,$data);
    }
}