<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/24/2017
 * Time: 10:55 AM
 */

namespace App\Business;


use App\Models\User;

class ChangePasswordBusiness
{
    public function changePassword($id,$password)
    {
        $model=new User();
        return $model->changePassword($id,$password);
    }
}