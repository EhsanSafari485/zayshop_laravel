<?php

namespace App\Http\Requests\sliders;

use Illuminate\Foundation\Http\FormRequest;

class requestSliderEdit extends FormRequest
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
            'url'=>'required|url',
        ];
    }

    public function messages (): array
    {
        return [
            'url.required'=>'لطفا این فیلد را پر کنید',
            'url.url'=>'این url معتبر نیست'
        ];
    }
}
