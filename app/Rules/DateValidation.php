<?php
// app/Rules/ValidateArrivalDate.php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class DateValidation implements ValidationRule
{
    protected $departureDate;

    public function __construct($departureDate)
    {
        $this->departureDate = $departureDate;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Convert to Carbon instances for proper comparison
        $departure = Carbon::parse($this->departureDate);
        $arrival = Carbon::parse($value);

        //  Check if departure date is provided
        if (empty($this->departureDate)) {
            $fail('The departure date field is required.');
            return;
        }
        // Check if departure date is valid
        if (!$departure->isValid()) {
            $fail('Invalid departure date format.');
            return;
        }

        // Check if arrival date is valid
        if (!$arrival->isValid()) {
            $fail('Invalid arrival date format.');
            return;
        }

        // Compare dates
        if ($arrival->lt($departure)) { // lt() = less than
            $fail('The arrival date must be on or after the departure date.');
        }
    }
}
