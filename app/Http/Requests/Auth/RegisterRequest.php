<?php

namespace App\Http\Requests\Auth;

use Carbon\Carbon;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function getValidatorInstance()
    {
        //生年月日をまとめる為のメソッド
        $format = '%04d-%02d-%02d';
        //$format = 'Y-m-d';
        $old_year = $this->input('old_year');
        $old_month = $this->input('old_month');
        $old_day = $this->input('old_day');

        $birth_day = sprintf($format, $old_year, $old_month, $old_day);

        //dd($birth_day);

        $this->merge(['birth_day' => $birth_day]);
        //birth_day フィールドをリクエストデータに追加
        //override（内容を上書きするために使用）
        \Log::debug($this->birth_day);
        //dd($this->all()); // これでリクエストデータを確認

        return parent::getValidatorInstance();
    }
    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' => 'required|min:5|max:100|email|unique:users,mail_address',
            'sex' => 'required|in:1,2,3',
            //'birth_day'自体が認識されていない可能性
            'birth_day' => 'required|date|before:today|date|after:1999-12-31',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|confirmed|min:8|max:30',
            'password_confirmation' => 'required|same:password'
        ];
    }


    //
}
