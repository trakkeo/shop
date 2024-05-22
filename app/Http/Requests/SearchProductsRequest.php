<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'price' => ['numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'gte:0', 'nullable'],
            'memory' => ['numeric', 'gte:0', 'nullable'],
            'screen_size' => ['numeric', 'gte:0', 'nullable'],
            'name' => ['string', 'nullable'],
        ];
    }
}
