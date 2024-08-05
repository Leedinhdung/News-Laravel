<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required|same:password'
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Vui lòng nhập họ',
            'last_name.required' => 'Vui lòng nhập tên',
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.unique' => 'Tên tài khoản đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
            'password.regex'=>'Mật khẩu phải bao gồm chữ hoa, chữ số và kí tự đặc biệt',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirmation.same' => 'Mật khẩu bạn vừa nhập không khớp'
        ];
    }
}
