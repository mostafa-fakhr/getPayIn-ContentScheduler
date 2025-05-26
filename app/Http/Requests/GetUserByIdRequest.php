<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetUserByIdRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'userId' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User ID is required.',
            'id.integer' => 'User ID must be a number.',
            'id.exists' => 'No user found with this ID.',
        ];
    }
}
