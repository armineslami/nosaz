<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CalculateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Exclude specific fields like _token and formula
        $data = $this->except(['_token', 'name', 'description', 'formula']);

        // Define validation rules dynamically for each key
        foreach ($data as $key => $value) {
            $rules[$key] = [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!is_null($value)) {
                        if (!is_numeric($value)) {
                            $fail(__('validation.integer', ['attribute' => ""]));
                        }
                        if ($value < 0) {
                            $fail(__('validation.min.numeric', ['attribute' => "", 'min' => 0]));
                        }
                    }
                }
            ];
        }

        return $rules;
    }

}
