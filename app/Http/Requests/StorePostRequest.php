<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:100000',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     */
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.string'   => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max'      => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung không được để trống.',
            'content.string'   => 'Nội dung phải là chuỗi ký tự.',
            'content.max'      => 'Nội dung không được vượt quá 100000 ký tự.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors(),
        ], 422));
    }
}
