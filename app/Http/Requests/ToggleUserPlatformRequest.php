<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToggleUserPlatformRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'platform_id' => ['required', 'integer', 'exists:platforms,id'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
