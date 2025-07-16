<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Passport implements ValidationRule
{
    public function validateAlphaNum($value)
    {
        if (! is_string($value) && ! is_numeric($value)) {
            return false;
        }

        if (strlen($value) > 10) {
            return false;
        }

        return preg_match('/\A[a-zA-Z0-9]+\z/u', $value) > 0;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /*
        if (!preg_match('/^[A-Z]{1}[0-9]{7}$/', $value)) {
            $fail('Invalid Indian Passport Number.');
        }
        */
        if (!$this->validateAlphaNum($value)) {
            $fail('Invalid Passport Number.');
        }
    }
}
