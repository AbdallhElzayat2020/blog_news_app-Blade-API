<?php

namespace App\Http\Requests\Frontend\Dashboard;

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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'comment_able' => ['nullable', 'in:on,off'],
            'category_id' => ['exists:categories,id'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'user_id' => ['exists:users,id'],
        ];
    }
}
