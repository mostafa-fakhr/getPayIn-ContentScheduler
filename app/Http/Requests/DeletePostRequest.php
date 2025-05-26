<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeletePostRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'postId' => ['required', 'integer', 'exists:posts,id'],
        ];
    }

    public function messages()
    {
        return [
            'postId.required' => 'Post ID is required.',
            'postId.integer' => 'Post ID must be a number.',
            'postId.exists' => 'No post found with this ID.',
        ];
    }
}
