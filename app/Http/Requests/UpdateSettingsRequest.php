<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
        return [
            'app_theme' => 'required|string|in:system,light,dark',
            'app_paginate_number' => 'required|numeric|min:1|max:100',
            'app_max_decimal_place' => 'required|numeric|min:0|max:5',
            'app_scalable' => 'required|numeric|in:0,1',
            'app_show_default_formula' => 'required|numeric|in:0,1'
        ];
    }
}
