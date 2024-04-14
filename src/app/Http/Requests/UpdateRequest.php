<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'shop_id' => 'required',
            'shop_name' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'shop_id.required' => '店舗IDを入力してください',
            'shop_name.required' => '店舗名を入力してください',
        ];
    }

}
