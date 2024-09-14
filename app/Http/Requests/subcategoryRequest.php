<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subcategoryRequest extends FormRequest
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
            //
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category'
        ];
    }

    public function messages()
    {
        return [
            'main_category_id.required' => 'メインカテゴリーを選択してください。',
            'sub_category_name.required' => '入力必須です。',
            'sub_category_name.unique' => '同じサブカテゴリーが既に存在します。',
            'sub_category_name.max:100' => '100文字以下にしてください。',
        ];
    }
}
