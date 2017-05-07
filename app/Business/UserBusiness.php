<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/23/2017
 * Time: 2:42 PM
 */

namespace App\Business;


use App\Models\User;
use App\Models\User_Category;

class UserBusiness
{
    public function checkHaveAnyCategory($id)
    {
        $model=new User_Category();
        return $model->checkHaveAnyCategory($id);
    }
    public function getUserInfo($id)
    {
        $model=new User();
        return $model->getUserInfo($id);
    }
}