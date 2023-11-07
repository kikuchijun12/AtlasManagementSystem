<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' => 'required|min:5|max:100|email',
            'sex' => 'required|in:1,2,3',
            'birth_day' => 'after_or_equal:2000-01-01|before_or_equal:' . now()->format('Y-m-d'),
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|confirmed|min:8|max:30',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
