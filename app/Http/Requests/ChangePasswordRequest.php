<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_pwd'=>'required',
            'new_pwd'=>'required|min:6',
            'renew_pwd'=>'required|same:new_pwd',
        ];
    }
    public function messages()
    {
        return [
            'current_pwd.required'=>'Enter current password',
            'new_pwd.required'=>'Enter new password',
            'new_pwd.min'=>'New password at least 6 characters',
            'renew_pwd.required'=>'Enter new password secondtime',
            'renew_pwd.same'=>'The password do not match',
        ];
    }
}
