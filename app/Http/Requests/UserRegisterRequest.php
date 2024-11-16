<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:8|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'string', 'confirmed','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là trường bắt buộc.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.min' => 'Tên phải có ít nhất 8 kí tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên này đã được sử dụng.',

            'email.required' => 'Email là trường bắt buộc.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã được sử dụng.',

            'password.required' => 'Mật khẩu là trường bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ cái in hoa, 1 chữ cái thường, 1 ký tự số và 1 ký tự đặc biệt.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors(),
        ], 422));
    }
}
