<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
            'phone' => ['required', 'unique:users,phone', 'max:18'],
            'status' => ['required', 'in:active,inactive'],
            'email_verified_at' => ['nullable', 'in:active,inactive'],
            'city' => ['nullable', 'max:80', 'string'],
            'country' => ['nullable', 'max:80', 'string', 'min:2'],
            'street' => ['nullable', 'max:80', 'string', 'min:2'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
        ];
    }
}
