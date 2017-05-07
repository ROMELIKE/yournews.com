<?php

namespace App\Models;

use App\YourNewsBusiness\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Post_Category extends Model
{
    protected $table = 'post_category';

    //Hàm: show ra bài viết theo chuyên mục của từng user
    public function showPostByCategoryId($id)
    {
        $date = date("Y-m-d");
        $result = new ResultObject();
        try {
            $sql = DB::table('post_category')->select(['post.*', 'category.*'])
                ->join('post', 'post.post_id', '=', 'post_category.post_id')
                ->join('category', 'post_category.category_id', '=',
                    'category.cat_id')
                ->join('user_category', 'category.cat_id', '=',
                    'user_category.category_id')
                ->where('user_category.user_id', $id)
                ->whereDate('post.create_at',$date)
                ->orderBy('create_at', 'desc')->get()->toArray();
            if (count($sql)) {
                $result->messageCode = 1;
                $result->message = 'This user have some posts';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'This user dont  have any posts';
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }
    //hàm show ra bài viết theo chuyên mục của user có bộ lọc


    /**
     * @return ResultObject
     *
     * Hàm: Show ra bài viết default(theo chuyên mục admin chọn, bộ lọc mới nhất)
     */
    public function showPostDefault()
    {
        $result = new ResultObject();

        //lấy ngẫu nhiên 6 Cat_id trong tất cả các chuyên mục
        $model = new Category();
        $listCatId = $model->getAllCateGory()->result;
        $data = [];
        foreach ($listCatId as $item) {
            $data[] = $item->cat_id;
        }
        $randomCatId = array_rand($data, 6);
        //end

        try {
            $sql = DB::table('post_category')->select(['post.*', 'category.*'])
                ->join('post', 'post.post_id', '=', 'post_category.post_id')
                ->join('category', 'post_category.category_id', '=',
                    'category.cat_id')
                ->join('user_category', 'category.cat_id', '=',
                    'user_category.category_id')
                ->whereIn('category.cat_id', $randomCatId)
                ->orderBy('create_at', 'desc')->get()->toArray();
            if (count($sql)) {
                $result->messageCode = 1;
                $result->message = 'This user have some posts';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'This user dont any have posts';
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }

    public function showPostFilter()
    {
        $result = new ResultObject();

    }
}
