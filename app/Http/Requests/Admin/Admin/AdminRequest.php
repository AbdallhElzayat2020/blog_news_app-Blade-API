<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin_id = $this->route('admin');
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:150', 'unique:admins,username,' . $admin_id],
            'email' => ['required', 'email', 'max:150', 'unique:admins,email,' . $admin_id],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:50'],
            'password_confirmation' => ['required', 'same:password'],
            'phone' => ['nullable', 'string', 'min:10', 'max:20'],
            'status' => ['required', 'in:active,inactive'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}
