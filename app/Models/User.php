<?php

namespace App\Models;

use App\YourNewsBusiness\ResultObject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use DateTime;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable
        = [
            'username',
            'password',
            'facebook_id',
            'avatar'
        ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * @param $id
     *
     * @return ResultObject
     * hàm kiểm tra, sự tồn tại của user_id trong csdl
     */
    public function checkExistId($id)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)->get()
                ->count();
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Exist user id';
                $result->numberOfResult = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Not Exist user id like that';
                $result->numberOfResult = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }
    public function checkUserName($uName)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table('user')->where('username', $uName)->first();
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Exist username ';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Not Exist username like that';
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = $ex->getMessage();
        }

        return $result;
    }

    public function addUser($array)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->insertGetId($array);
            if (count($sql)) {
                $result->messageCode = 1;
                $result->message = 'Add user successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Add user failure';
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }

    public function getUserInfo($id)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)->first();
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Query successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Query failure';
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }

    public function changePassword($id, $password)
    {
        $data = ['password' => $password];
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)
                ->update($data);
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Change password successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Change password failure';
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }

    public function updateUserInfo($id, $data)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)
                ->update($data);
            if (count($sql)) {
                $result->messageCode = 1;
                $result->message = 'Update user info successfully';
                $result->result = $sql;
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Update user info failure';
                $result->result = $sql;
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }

    public function checkEmailPhoneNumber($array)
    {
        $email = $array['email'];
        $phone = $array['phone'];
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('email', $email)
                ->where('sdt', $phone)->get()->toArray();
            if ($sql) {
                $result->result = $sql;
                $result->message = 'Query successfully';
                $result->messageCode = 1;
                $result->numberOfResult = count($sql);
            } else {
                $result->result = $sql;
                $result->message = 'Query failure';
                $result->messageCode = 0;
                $result->numberOfResult = count($sql);
            }
        } catch (\Exception $ex) {
            $result->result = $sql;
            $result->message = 'SQL exception';
            $result->messageCode = 1;
            $result->numberOfResult = count($sql);
        }

        return $result;
    }

    public function updateUser($id, $array)
    {
        $data=[];
        if (isset($array['username']) && $array['username']) {
            $data['username'] = $array['username'];
        }
        if (isset($array['password']) && $array['password']) {
            $data['password'] = $array['password'];
        }
        if (isset($array['email']) && $array['email']) {
            $data['email'] = $array['email'];
        }
        if (isset($array['sdt']) && $array['sdt']) {
            $data['sdt'] = $array['sdt'];
        }
        if (isset($array['avatar']) && $array['avatar']) {
            $data['avatar'] = $array['avatar'];
        }
        if (isset($array['sex']) && $array['sex']) {
            $data['sex'] = $array['sex'];
        }
        if (isset($array['last_login']) && $array['last_login']) {
            $data['last_login'] = $array['last_login'];
        }
        if (isset($array['status']) && $array['status']) {
            $data['status'] = $array['status'];
        }
        $data['update_at'] = new DateTime();
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('user_id', $id)
                ->update($data);
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Update User successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Update User failure';
                $result->result = $sql;
            }
        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message = 'SQL exception';
        }

        return $result;
    }
}
