<?php

namespace App\Traits\Forms;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait FormValidationTrait
{
    private bool $failedCheckValidate = false;

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
     * @return string
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:32 ICT
     */
    public function validatorErrors(): string
    {
        $errors = [];

        foreach ($this->getValidatorInstance()->errors()->toArray() as $key => $value) {
            foreach ($value as $message) {
                $errors[] = $message;
            }
        }

        return implode('<br />', $errors);
    }

    /**
     * failed validation
     *
     * @throws ValidationException
     * @since 7.0.0 - 2022-09-26, 23:38 ICT
     * @author malayvuong
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->failedCheckValidate) {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}
