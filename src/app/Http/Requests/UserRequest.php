<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '名前は必須です',
            'name.unique' => 'この名前はすでに使われています',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスはメール方式で入力してください',
            'email.unique' => 'このメールアドレスはすでに使われています',
            'password.required' => 'パスワードは必須です',
            'password.min' => 'パスワードは8文字以上で入力してください'
        ];
    }
}
