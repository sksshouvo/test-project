<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\LeaveApplication;

class CheckLeave implements DataAwareRule, ValidationRule
{
         /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

     // ...
     /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkLeave = LeaveApplication::dateRangeWiseFilter($this->data['start_date'], $value)->withoutStatusWiseFilter("rejected")->first();
        
        if ($checkLeave) {
            $fail('There is existing leave application against these dates, try different dates');
        }
    }
}
