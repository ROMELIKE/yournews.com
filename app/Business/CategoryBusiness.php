<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/23/2017
 * Time: 2:57 PM
 */

namespace App\Business;


use App\Models\Category;

class CategoryBusiness
{
    public function getAllCateGory()
    {
        $model=new Category();
        return $model->getAllCateGory();
    }
}