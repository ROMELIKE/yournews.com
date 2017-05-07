<?php

namespace App\Models;

use App\YourNewsBusiness\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{
    public $table = 'post';

    /**
     * @param $id
     *
     * @return ResultObject
     * hàm: lấy ra bài viết theo id lựa chọn
     */
    public function getPostByPostId($id)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('post_id', $id)->first();
            if ($sql) {
                $result->result = $sql;
                $result->message = 'Query successfully';
                $result->messageCode = 1;
            } else {
                $result->message = 'Query failure!!';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL Exepction';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param $array
     * @param $catId
     *
     * @return ResultObject
     *
     * Hàm: thêm bài viết vào CSDL, thêm vào bảng post và thêm vào bảng post-category
     */
    public function insertNew($array, $catId)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table('post')->insertGetId($array);
            $sql2 = DB::table('post_category')
                ->insert(['post_id' => $sql, 'category_id' => $catId]);
            if ($sql && $sql2) {
                $result->result = $sql2;
                $result->message = 'insert successfully';
                $result->messageCode = 1;
            } else {
                $result->message = 'insert failure!!';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL Exepction';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param $url
     *
     * @return ResultObject
     * Hàm: kiểm tra xem link có bị trùng hay không?
     */
    public function checkSameLink($url)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('source_url', $url)->get();
            if (!count($sql)) {
                $result->message = 'The post ready to insert';
                $result->messageCode = 1;
            } else {
                $result->message = 'This post have already!';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL Exepction';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @return ResultObject
     * Hàm: lấy ra danh sách các bài viết chưa có nội dung.
     */
    public function getPostNullContent()
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->select('post_id','content','source_url')->where('content', null)->get()
                ->toArray();
            if ($sql) {
                $result->result = $sql;
                $result->message = 'there are null posts';
                $result->messageCode = 1;
            } else {
                $result->message = 'there is no null post!';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL Exepction';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Hàm: update content theo url.
     *
     * @param $url
     * @param $content
     *
     * @return ResultObject
     */
    public function updateContent($url, $content)
    {
        $result = new ResultObject();
        $array = ['content' => $content];
        try {
            $sql = DB::table('post')->where('source_url',$url)
                ->update($array);
            if ($sql) {
                $result->message = 'update successfully';
                $result->messageCode = 1;
            } else {
                $result->message = 'update failure!!';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL Exepction';
            $result->messageCode = 0;
        }

        return $result;
    }
}
