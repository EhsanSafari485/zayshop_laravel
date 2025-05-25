<?php

namespace App\Http\Requests\blog;

use Illuminate\Foundation\Http\FormRequest;

class blogEditRequest extends FormRequest
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
            'title' => 'required|min:3',
            'slug' => 'required|alpha_dash|min:3|unique:blogs,slug,'. $id,
            'content' => 'required',
        ];
    }

    public function messages(): array
    {
        return [

            'required' => 'لطفا این فیلد را پر کنید.',
            'min' => 'عنوان باید حداقل 3 کاراکتر باشد.',
            'slug.unique' => 'این شناسه باید یکتا باشد',
            'slug.alpha_dash' => 'اسلاگ فقط باید شامل حروف لاتین، اعداد،(- و _ ) باشد.' ,
            'slug.unique' => 'این شناسه باید یکتا باشد',


        ];
    }
}
