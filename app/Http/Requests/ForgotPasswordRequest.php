<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Policies\TaskPolicy;
use App\Task;

class ForgotPasswordRequest extends FormRequest
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
            'fg_email'=>'required|email',
            'fg_phone'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'fg_email.required'=>'Enter your email',
            'fg_email.email'=>'Enter exactly email format',
            'fg_phone'=>'Enter your phone number',
        ];
    }
}
