<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'email'=>['required','email'],
            'password'=>['required','min:6'],
        ];
    }

    public function messages()
    {
        return [
            'required'=>'لطفا فیلد های خالی پر کنید',
            'email.email'=>' ایمیل معتبر نیست',
            'password.min'=>'روز عبور باید حداقل 6 کارکتر باشد'
        ];
    }
}
