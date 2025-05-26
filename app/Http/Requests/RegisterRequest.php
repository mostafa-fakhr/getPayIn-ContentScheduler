<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\ValidationRule;
use App\Constants\Regex;

class RegisterRequest extends FormRequest
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
            'name' => array_merge(['required'], ValidationRule::USERNAME),
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:' . Regex::PASSWORD,
            ],
        ];
    }
}
