<?php

namespace App\Models;

use App\YourNewsBusiness\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class User_Category extends Model
{

    protected $table = 'user_category';

    /**
     * @param $id
     *
     * @return ResultObject
     *
     * Hàm: kiểm tra user nhập vào đã có category nào chưa?
     */
    public function checkHaveAnyCategory($id)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)->get();
            if (count($sql) > 0) {
                $result->messageCode = 1;
                $result->message = "this user choosed ".count($sql)
                    ." category!!!";
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'this user dont have any category';
            }
        } catch (\Exception $exception) {
            $result->messageCode = 0;
            $result->message = 'SQL Exepction!!!';
        }

        return $result;
    }

    /**
     * @param $id
     *
     * @return ResultObject
     *
     * Hàm: lấy ra danh sách các chuyên mục user đã chọn.
     */
    public function getCategoryByUserId($id)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)
                ->join('category', 'user_category.category_id', '=',
                    'category.cat_id')->where('user_category.user_id', $id)
                ->get();
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Query Successfully!!!';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Query Failure';
            }
        } catch (\Exception $exception) {
            $result->messageCode = 0;
            $result->message = 'SQL Exepction!!!';
        }

        return $result;
    }


    /**
     * @param $id
     *
     * @return ResultObject
     *
     * Hàm: lấy ra danh sách các chuyên mục, mà user chưa chọn,
     */
    public function getCategoryUserNotChoose($id)
    {
        $result = new ResultObject();
        try {
//            $sql = DB::select("SELECT DISTINCT category.cat_name , category.*
//                FROM user_category
//                INNER JOIN category ON user_category.category_id = category.cat_id
//                WHERE user_category.category_id NOT IN
//                (SELECT category.cat_id FROM user_category
//                INNER JOIN category ON user_category.category_id = category.cat_id WHERE user_category.user_id = $id)");
            $sql= DB::select("SELECT *
                FROM category
                WHERE cat_id NOT IN 
                (SELECT category.cat_id FROM user_category
                INNER JOIN category ON user_category.category_id = category.cat_id WHERE user_category.user_id = $id)");
            if (count($sql) > 0) {
                $result->messageCode = 1;
                $result->message = 'Query Successfully!!';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Query Failure';
            }

        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL excepction';
        }

        return $result;
    }

    /**
     * @param $id
     * @param $array
     *
     * @return ResultObject
     *
     * Hàm: cho phép user lưu chọn và lưu chuyên mục ưa thích
     */
    public function userAddCategory($id, $array)
    {
        $result = new ResultObject();
        if (isset($array) && !empty($array)) {
            foreach ($array as $item) {
                try {
                    $sql = DB::table('user_category')->where('user_id', $id)
                        ->insert(['user_id' => $id, 'category_id' => $item]);
                    if ($sql) {
                        $result->message = 'Query Successfully';
                        $result->messageCode = 1;
                    } else {
                        $result->message = 'Query failure';
                        $result->messageCode = 0;
                    }
                } catch (\Exception $ex) {
                    $result->message = 'SQL excepction';
                    $result->messageCode = 0;
                }
            }
        }else{
            $result->message = 'SQL excepction';
            $result->messageCode = 0;
        }
        return $result;
    }

    /**
     * @param $id
     * @param $array
     *
     * @return ResultObject
     *
     * Hàm: cho phép user xóa các chuyên mục trong hồ sơ của mình.
     */
    public function userDeleteAllCategory($id)
    {
        $result = new ResultObject();

        try {
            $sql = DB::table('user_category')->where('user_id', $id)->delete();
            if ($sql > 0) {
                $result->message = 'Query Successfully';
                $result->messageCode = 1;
            } else {
                $result->message = 'Dont have any record to delete';
                $result->messageCode = 0;
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL excepction';
            $result->messageCode = 0;
        }

        return $result;
    }
//cơ chế update: xóa hết dữ liệu cũ của user đó theo user id.

//insert lại tất cả những thứ gì được chọn theo user id.
    public function updateUserCategory($id, $array)
    {
        $result = new ResultObject();
        try {
            $delSql = DB::table('user_category')->where('user_id', $id)
                ->delete();
            foreach ($array as $item) {

                $insertSql = DB::table('user_category')->where('user_id', $id)
                    ->insert(['user_id' => $id, 'category_id' => $item]);
                if ($insertSql) {
                    $result->message = 'Query Successfully';
                    $result->messageCode = 1;
                } else {
                    $result->message = 'Query failure';
                    $result->messageCode = 0;
                }
            }
        } catch (\Exception $ex) {
            $result->message = 'SQL excepction';
            $result->messageCode = 0;
        }

        return $result;
    }


}
