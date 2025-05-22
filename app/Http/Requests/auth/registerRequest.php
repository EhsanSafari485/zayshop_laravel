<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:4',
            'password' => 'required|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'لطفاً ایمیل را وارد کنید',
            'email.email' => 'فرمت ایمیل معتبر نیست',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است',
            'name.required' => 'نام الزامی است',
            'name.min' => 'نام باید حداقل ۴ کاراکتر باشد',
            'password.required' => 'رمز عبور الزامی است',
            'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد',
        ];
    }

}
