<?php

namespace App\Http\Requests;

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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'roles' => 'required|array', 
            'roles.*' => 'exists:roles,id', 
        ];
        if($this->isMethod('patch')) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->route('admin')->user_id;
            $rules['password'] = 'nullable';
        }
        return $rules;
    }
}
