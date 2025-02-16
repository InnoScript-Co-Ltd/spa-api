<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\{
    RoleTypeEnum,
    UserStatusEnum
};
use App\Helpers\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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

        $roles = implode(',', (new Enum(RoleTypeEnum::class))->values());
        $status = implode(',', (new Enum(UserStatusEnum::class))->values());
        return [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:8', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            "role" => "required|in:$roles",
            "status" => "required|in:$status"
        ];
    }
}
