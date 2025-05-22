<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'image' => 'required',
            'slug' => 'required|alpha_dash|unique:categories,slug'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'لطفا یه نام وارد کنید.',
            'name.min' => 'نام باید حداقل 3 کاراکتر باشد.',
            'image.required' => 'لطفا یک تصویر انتخاب کنید.',
            'slug.required' => 'لطفا این فیلد را پر کنید',
            'slug.unique' => 'این شناسه باید یکتا باشد',
            'slug.alpha_dash' => 'اسلاگ فقط باید شامل حروف لاتین، اعداد،(- و _ ) باشد.'
        ];
    }

}
