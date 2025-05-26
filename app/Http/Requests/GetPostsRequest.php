<?php

namespace App\Http\Requests;

use App\Constants\Pagination;
use Illuminate\Foundation\Http\FormRequest;

class GetPostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|string|in:scheduled,published,draft',
            'date' => 'nullable|date',
            'per_page' => 'nullable|integer|min:1|max:' . Pagination::MAX_PER_PAGE,
        ];
    }
}
