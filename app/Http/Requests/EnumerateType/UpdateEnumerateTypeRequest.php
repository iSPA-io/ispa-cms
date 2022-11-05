<?php

namespace App\Http\Requests\EnumerateType;

use App\Traits\Forms\FormValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnumerateTypeRequest extends FormRequest
{
    use FormValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'key_name' => 'required|string|max:50',
        ];
    }
}
