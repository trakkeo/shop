<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name' => ['required', 'min:8'],
            'description' => ['required', 'min:8'],
            'cpu' => ['required'],
            'memory' => ['required'],
            'screen_size' => ['required'],
            'price' => ['required', 'numeric', 'gte:0'],
            'status' => ['required', 'boolean'],
            'starred' => ['required', 'boolean'],
            'options' => ['array', 'exists:options,id', 'required'],
            'pictures' => ['array'],
            'pictures.*' => ['image', 'max:2000']
        ];
    }
}
