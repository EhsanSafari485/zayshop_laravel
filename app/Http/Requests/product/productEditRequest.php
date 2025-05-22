<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class productEditRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'brand' => 'required|min:3',
            'slug' => 'required|alpha_dash|unique:products,slug,'. $id,

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'لطفا این فیلد را پر کنید.',
            'price.required' => 'لطفا این فیلد را پر کنید.',
            'brand.required' => 'لطفا این فیلد را پر کنید.',
            'slug.required' => 'لطفا این فیلد را پر کنید.',
            'name.min' => 'نام باید حداقل 3 کاراکتر باشد.',
            'brand.min' => 'برند باید حداقل 3 کاراکتر باشد.',
            'price.numeric' => 'این فیلد مقدار عدد  می گیرد',
            'slug.unique' => 'این شناسه باید یکتا باشد',
            'slug.alpha_dash' => 'اسلاگ فقط باید شامل حروف لاتین، اعداد،(- و _ ) باشد.'
        ];
    }
}
