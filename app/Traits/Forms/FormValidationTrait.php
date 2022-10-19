<?php

namespace App\Traits\Forms;

use App\Constants\Constants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait FormValidationTrait
{
    /**
     * Check for validator fail status
     *
     * @return bool
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:30 ICT
     */
    public function validatorFails(): bool
    {
        return $this->getValidatorInstance()->fails();
    }

    /**
     * Get validator error messages
     *
     * @return array
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:32 ICT
     */
    public function validatorErrors(): array
    {
        $errors = [];

        foreach ($this->getValidatorInstance()->errors()->toArray() as $value) {
            foreach ($value as $message) {
                $errors[] = $message;
            }
        }

        return $errors;
    }

    /**
     * failed validation
     *
     * @throws ValidationException
     * @since 7.0.0 - 2022-09-26, 23:38 ICT
     * @author malayvuong
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, response()->json([
            'status' => Constants::STATUS_FAILED,
            'message' => $this->validatorErrors(),
        ], Response::HTTP_NOT_ACCEPTABLE));
    }
}
