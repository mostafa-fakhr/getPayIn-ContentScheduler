<?php

namespace App\Http\Requests;

use App\Constants\PostStatusConstants;
use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Regex;
use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
            'scheduled_time' => 'nullable|date',
            'status' => ['nullable', 'in:' . implode(',', PostStatusConstants::POST_STATUS_CONSTANTS_ARR)],
            'platforms' => 'required|array',
            'platforms.*' => 'exists:platforms,id',
        ];
    }
}
