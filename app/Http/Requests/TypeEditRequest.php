<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_name_update'=> 'required|unique:types|min:3|max:100',
        ];
    }
}
