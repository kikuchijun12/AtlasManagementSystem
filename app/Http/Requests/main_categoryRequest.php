<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class main_categoryRequest extends FormRequest
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
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category'
            //
        ];
    }
    public function messages()
    {
        return [
            'main_category_name.required' => '入力必須です。',
            'main_category_name.unique' => '同じメインカテゴリーが既に存在します。',
            'main_category_name.max:100' => '100文字以下にして下さい。'

        ];
    }
}
