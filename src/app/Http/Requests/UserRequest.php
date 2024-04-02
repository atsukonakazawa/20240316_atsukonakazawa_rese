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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Usernameは必須です',
            'email.required' => 'Emailは必須です',
            'email.email' => 'emailはメール方式で入力してください',
            'password.required' => 'Passwordは必須です',
            'password.min' => 'Passwordは8文字以上で入力してください'
        ];
    }
}
