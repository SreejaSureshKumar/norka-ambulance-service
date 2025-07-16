<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber implements ValidationRule
{
    protected $country_code;

    public function __construct($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phone_util = PhoneNumberUtil::getInstance();
        try {
            $regex = '/[^0-9\(\)]/';
            if (strtolower($this->country_code) === 'in') {
                $regex = '/[^0-9]/';
            }
            if ($value && (preg_match($regex, substr($value, 0, 1)) || preg_match($regex, substr($value, -1, 1)))) {
                $fail('The :attribute should not start or end with special characters.');
            }
            $number_parsed = $phone_util->parse($value, $this->country_code);
            if (!$phone_util->isValidNumber($number_parsed)) {
                $fail('The :attribute is not a valid phone number.');
            }
        } catch (\Exception $e) {
            $fail('The :attribute is not a valid phone number.');
        }
    }
}
