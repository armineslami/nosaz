<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateLabelRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'type' => 'in:1,0',
            'parent' => 'integer|exists:labels,id',
            'unit' => 'nullable|in:millimeter,centimeter,meter,square_meter,lane_meter,milligram,gram,kilogram,ton,number,percent,toman,rial'
        ];
    }
}
