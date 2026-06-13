<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * 1. バリデーションを実行する権限があるかどうか（今回は全員許可するため true にします）
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 2. テストの指示に基づくバリデーションルール
     */
    public function rules()
    {
        return [
            'last_name'  => ['required', 'string', 'max:4'],  // 姓: 必須、最大4文字
            'first_name' => ['required', 'string', 'max:4'],  // 名: 必須、最大4文字
            'gender'     => ['required'],
            'email'      => ['required', 'email'],
            'tel_1'      => ['required', 'numeric', 'digits_between:2,5'], // 電話1: 必須、数字2〜5桁
            'tel_2'      => ['required', 'numeric', 'digits_between:2,4'], // 電話2: 必須、数字2〜4桁
            'tel_3'      => ['required', 'numeric', 'digits_between:3,4'], // 電話3: 必須、数字3〜4桁
            'address'    => ['required'],
            'category'   => ['required'],
            'content'    => ['required', 'max:120'],
        ];
    }
    
    /**
     * エラーメッセージを日本語にカスタムする
     */
    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'last_name.max'        => '姓は4文字以内で入力してください',
            'first_name.required'  => '名を入力してください',
            'first_name.max'       => '名は4文字以内で入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            
            // 電話番号のエラーメッセージ（半角の5桁に統一）
            'tel_1.required'       => '電話番号を入力してください',
            'tel_1.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_1.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_2.required'       => '電話番号を入力してください',
            'tel_2.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_2.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_3.required'       => '電話番号を入力してください',
            'tel_3.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_3.digits_between' => '電話番号は5桁まで数字で入力してください',
            
            'address.required'     => '住所を入力してください',
            'category.required'    => 'お問い合わせの種類を選択してください',
            'content.required'     => 'お問い合わせ内容を入力してください',
            'content.max'          => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}