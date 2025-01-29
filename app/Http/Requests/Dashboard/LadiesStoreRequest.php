<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LadiesStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'nrc' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:ladies,phone',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'join_date' => 'required|date',
            'leave_date' => 'required|date',
        ];
    }
}
