<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 2/23/2017
 * Time: 7:20 PM
 */

namespace App\Business;


use App\Models\Post_Category;

class Post_CategoryBusiness
{
    /**
     * Hàm: hiển thị ra trang chủ, những bài viết theo hồ sơ của từng user.
     * @param $id
     *
     * @return \App\YourNewsBusiness\ResultObject
     *
     */
    public function getIndex($id)
    {
        $model=new Post_Category();
        return $model->showPostByCategoryId($id);
    }

    /**
     * Hàm: hiển thị ra trang chủ, những bài viết mặc định, nếu user chưa có hồ sơ bài viết
     * @return \App\YourNewsBusiness\ResultObject
     */
    public function getIndexDefault()
    {
        $model=new Post_Category();
        return $model->showPostDefault();
    }
}