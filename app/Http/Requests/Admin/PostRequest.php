<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:20',
            'author' => 'required',
            'excerpt' => 'required|min:50',
            'content' => 'required|min:50',

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.min' => 'Tiêu đề bài viết quá ngắn',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'excerpt.required' => 'Vui lòng nhập tóm tắt bài viết',
            'excerpt.min' => 'Tóm tắt bài viết quá ngắn',
            'content.required' => 'Vui lòng nhập nội dung bài viết',
            'content.min' => 'Nội dung bài viết quá ngắn',
        ];
    }
}
