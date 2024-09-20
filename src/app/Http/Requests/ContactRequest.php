<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|integer|in:1,2,3',
            'email' => 'required|email|max:255',
            'tell_part1' => 'required|numeric|digits_between:1,5',
            'tell_part2' => 'required|numeric|digits_between:1,5',
            'tell_part3' => 'required|numeric|digits_between:1,5',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'detail' => 'required|string|max:120',
        ];
    }

    // エラーメッセージのカスタマイズ
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください。',
            'first_name.required' => '名を入力してください。',
            'gender.required' => '性別を選択してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスはメール形式で入力してください。',
            'tell_part1.required' => '電話番号を入力してください。',
            'tell_part2.required' => '電話番号を入力してください。',
            'tell_part3.required' => '電話番号を入力してください。',
            'tell_part1.numeric' => '電話番号は5桁までの数字で入力してください。',
            'tell_part2.numeric' => '電話番号は5桁までの数字で入力してください。',
            'tell_part3.numeric' => '電話番号は5桁までの数字で入力してください。',
            'tell_part1.digits_between' => '電話番号は5桁までの数字で入力してください。',
            'tell_part2.digits_between' => '電話番号は5桁までの数字で入力してください。',
            'tell_part3.digits_between' => '電話番号は5桁までの数字で入力してください。',
            'address.required' => '住所を入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'detail.required' => 'お問い合わせ内容を入力してください。',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください。',
        ];
    }
}
