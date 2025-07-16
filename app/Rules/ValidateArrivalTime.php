<?php
// app/Rules/ValidateArrivalTime.php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class ValidateArrivalTime implements ValidationRule
{
    protected $departureDate;
    protected $arrivingDate;
    protected $departureTime;

    public function __construct($departureDate, $arrivingDate, $departureTime)
    {
        $this->departureDate = $departureDate;
        $this->arrivingDate = $arrivingDate;
        $this->departureTime = $departureTime;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $missingFields = [];

        if (empty($this->departureDate)) {
            $missingFields[] = 'departure date';
        }
        if (empty($this->arrivingDate)) {
            $missingFields[] = 'arriving date';
        }
        if (empty($this->departureTime)) {
            $missingFields[] = 'departure time';
        }
        if (empty($value)) {
            $missingFields[] = 'this field';
        }
        // Skip validation if any required field is empty
        if (!empty($missingFields)) {
            $lastField = array_pop($missingFields);
            $message = empty($missingFields)
                ? "Please provide the $lastField"
                : "Please provide " . implode(', ', $missingFields) . " and $lastField";
            $fail($message);
        }
        try {
            // Create full datetime objects for comparison
            $departure = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                "{$this->departureDate} {$this->departureTime}:00"
            );

            $arrival = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                "{$this->arrivingDate} {$value}:00"
            );

            // If dates are the same, compare times
            if ($this->arrivingDate === $this->departureDate) {
                if ($arrival->lte($departure)) {
                    $fail('The arrival time must be after the departure time');
                }
            }
        } catch (\Exception $e) {
            $fail('Invalid date/time format provided.');
        }
    }
}
