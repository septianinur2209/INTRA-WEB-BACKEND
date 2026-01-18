<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class STORequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => [ 'required', 'string', 'max:225'],
            'code' => [
                'required',
                'string',
                'max:225',
                Rule::unique('m_sto', 'code')->ignore($id)
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
