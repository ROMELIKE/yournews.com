<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/24/2017
 * Time: 5:40 PM
 */

namespace App\Business;


use App\Models\Post;

class PostBusiness
{
    public function getPostByPostId($id){
        $model=new Post();
        return $model->getPostByPostId($id);
    }
}