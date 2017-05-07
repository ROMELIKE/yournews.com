<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/27/2017
 * Time: 5:57 PM
 */

namespace App\Business;


use App\Models\User;

class LoginBusiness
{
    public function updateUser($id,$array){
        $model=new User();
        return $model->updateUser($id,$array);
    }
    public function checkUsername($uName){
        $model=new User();
        return $model->checkUserName($uName);
    }
}