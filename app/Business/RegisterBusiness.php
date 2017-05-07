<?php

namespace App\Business;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterBusiness
{
    public function postRegister($array)
    {
        $model=new User();
        return $model->addUser($array);
    }
}
