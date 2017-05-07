<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/25/2017
 * Time: 5:44 PM
 */

namespace App\Business;


use App\Models\User;

class ForgotPasswordBusiness
{
    public function checkEmailPhoneNumber($array)
    {
        $bus=new User();
        return $bus->checkEmailPhoneNumber($array);
    }
}