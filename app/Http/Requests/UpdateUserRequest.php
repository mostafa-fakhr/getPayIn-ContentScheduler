<?php

namespace App\Http\Requests;

use App\Constants\Regex;
use App\Constants\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'name' => array_merge(['sometimes', 'required'], ValidationRule::USERNAME),
            'email' => 'sometimes|required|email|unique:users,email,' . Auth::id(),
            'password' => [
                'sometimes',
                'nullable',
                'min:6',
                'regex:' . Regex::PASSWORD,
            ],
        ];
    }
}
