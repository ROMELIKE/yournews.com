<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/23/2017
 * Time: 4:38 PM
 */

namespace App\Business;


use App\Models\User_Category;

class User_CategoryBusiness
{
    public function userAddCategory($id, $array)
    {
        $model = new User_Category();
        return $model->userAddCategory($id,$array);
    }

    public function getCategoryByUserId($id)
    {
        $model = new User_Category();
        return $model->getCategoryByUserId($id);
    }

    public function getCategoryUserNotChoose($id)
    {
        $model = new User_Category();
        return $model->getCategoryUserNotChoose($id);
    }
}