<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $user = $this->user();
        // return $user != null && $user->tokenCan('create');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validated = [
            'name' => ['required'],
            'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['required', 'email', 'max:255', 'unique:customers'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'postal_code' => ['required'], // postalCode
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
        ];

        return $validated;
    }
    // protected function prepareForValidation()
    // {
    //     if ($this->postalCode) {
    //         $this->merge([
    //             'postal_code' => $this->postalCode,
    //         ]);
    //     }
    // }
}
