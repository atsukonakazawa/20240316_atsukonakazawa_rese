<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => 'required',
            'comment' => 'nullable|max:400',
            'review_img' => 'nullable|mimes:jpg,png|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '体験を５段階で評価してください',
            'comment.max' => '口コミは400文字以内で入力してください',
            'review_img.mimes' => '画像はjpg,jpeg,pngのいずれかの形式で追加ができます',
            'review_img.max' => '最大ファイルサイズは1024KBまでです'
        ];
    }
}
