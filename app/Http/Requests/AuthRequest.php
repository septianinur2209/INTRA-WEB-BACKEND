<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'nik'       => ['required'],
            'password'  => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'nik wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
}
