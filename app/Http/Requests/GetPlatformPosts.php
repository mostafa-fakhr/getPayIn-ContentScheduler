<?php

namespace App\Http\Requests;

use App\Constants\PostStatusConstants;
use Illuminate\Foundation\Http\FormRequest;

class GetPlatformPosts extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'status' => ['sometimes', 'in:' . implode(',', PostStatusConstants::POST_STATUS_CONSTANTS_ARR)],
            'scheduled_time' => 'sometimes|date',
            'created_at' => 'sometimes|date',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ];
    }
}
