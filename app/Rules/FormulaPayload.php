<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FormulaPayload implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression to match valid characters outside <>
        // Allowed characters: 1234567890-+=)(*^%/#, and <>
        $allowedCharactersPattern = '/^[0-9\-+=)(*^%\/#<>.]*$/';

        // Remove everything between <> for the check
        // The pattern finds anything between <>
        $outsideText = preg_replace('/<[^<>]*>/', '', $value);

        // Check if the remaining text outside <> contains only allowed characters
        if (!preg_match($allowedCharactersPattern, $outsideText)) {
            //            $fail('The :attribute contains invalid characters outside <>.');
            $fail(trans('validation.custom.formula.invalid'));
        }
    }
}
