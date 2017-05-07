<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|min:5|max:20',
            'avatar'=>'image|max:1024'
//          'avatar'=>'mimes:jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Enter Email',
            'email.email' => 'Enter exactly email format',
            'gender.required' => 'Enter gender',
            'phone.required' => 'Enter phone number',
            'phone.min' => 'This phone number is too short',
            'phone.max' => 'This phone number is too long',
            'avatar.image' => 'This is not image format',
            'avatar.size' => 'This image is too large, no bigger than 1024 kb',
        ];
    }
}
