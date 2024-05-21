<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'shop_name' => 'required',
            'area_id' => 'required',
            'genre_id' => 'required',
            'shop_detail' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'shop_name.required' => '店舗名を入力してください',
            'area_id.required' => 'エリアを選択してください',
            'genre_id.required' => 'ジャンルを選択してください',
            'shop_detail.required' => '店舗概要を入力してください',
        ];
    }
}
