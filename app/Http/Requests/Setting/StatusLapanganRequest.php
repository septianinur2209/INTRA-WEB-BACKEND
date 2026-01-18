<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StatusLapanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:225',
                Rule::unique('s_status_lapangans', 'name')->ignore($id)
            ],
            'status' => $id ? ['required', 'boolean'] : ['sometimes', 'boolean'],
        ];
    }

    /**
     * Override default failedValidation untuk JSON response
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'status' => false,
            'message' => 'Validation failed',
            'error' => true,
            'errors' => $validator->errors()
        ], 422));
    }
}
