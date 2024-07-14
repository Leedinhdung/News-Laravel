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
            'first_name.required' => 'The firstname field is required.',
            'last_name.required' => 'The lastname field is required.',
            'username.required' => 'The username field is required',
            'username.unique' => 'Username already exists',
            'password.required' => 'The password field required',
            'password.min' => 'Password must be at least 8 characters long',
            'password.regex'=>'Password must include uppercase letters, numbers and special characters',
            'email.required' => 'The email field is required',
            'email.unique' => 'Email already exists',
            'email.email' => 'Email is not valid',
            'password_confirmation.required' => 'Confirm Password Required',
            'password_confirmation.same' => 'Confirm Password does not match Password'
        ];
    }
}
