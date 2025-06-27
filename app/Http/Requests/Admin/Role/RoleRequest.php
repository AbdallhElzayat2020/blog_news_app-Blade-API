<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = $this->route('role');
        return [
            'role_name' => ['required', 'string', 'min:2', 'max:40', 'unique:roles,role_name,' . $id],
            'status' => ['required', 'in:active,inactive'],
            'permissions' => ['required', 'array', 'min:1'],
        ];
    }
}
