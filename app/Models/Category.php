<?php

namespace App\Models;

use App\YourNewsBusiness\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = 'category';

    /**
     * @return ResultObject
     *
     * Hàm: lấy ra tất cả các cat name, cat id của tất cả chuyên mục
     */
    public function getAllCateGory()
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->get()->toArray();
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

}
