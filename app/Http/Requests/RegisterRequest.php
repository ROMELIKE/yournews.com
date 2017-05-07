<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'rusername'=>'required|unique:user,username',
            'rpassword'=>'required|min:6',
            'rrepass'=>'required|same:rpassword',
            'remail'=>'email|unique:user,email',
        ];
    }
    public function messages()
    {
        return [
            'rusername.required'=>'Enter username',
            'rusername.unique'=>'Username have already',
            'rpassword.required'=>'Re enter password',
            'rpassword.min'=>'The password at least 6 characters',
            'rrepass.same'=>'The password do not match',
            'remail.email'=>'Enter exactly email format',
            'remail.unique'=>'This email have already',
        ];
    }
}
