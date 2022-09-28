<?php

namespace App\Http\Requests\Auth;

use App\Traits\Forms\FormValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'username' => 'string|required',
            'password' => 'string|required'
        ];
    }
}
