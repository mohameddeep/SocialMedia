<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) < 8) {
            $fail('The :attribute must be at least 8 characters');
            return;
        }


        if (!preg_match('/[a-z]/', $value)) {
            $fail('The :attribute must include at least one lowercase letter');
            return;
        }


        if (!preg_match('/[A-Z]/', $value)) {
            $fail('The :attribute must include at least one uppercase letter');
            return;
        }

        if (!preg_match('/[0-9]/', $value)) {
            $fail('The :attribute must include at least one number');
            return;
        }

        if (!preg_match('/[@$!%*#?&]/', $value)) {
            $fail('The :attribute must include at least one special character ( @$!%*#?&)');
        }
    }
}
