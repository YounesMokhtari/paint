<?php

namespace App\Http\Requests;

use App\Models\Comments\CommentFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            CommentFields::CONTENT => 'required|string|max:255',
            CommentFields::BLOG_POST_ID => 'required|exists:blog_posts,id',
        ];
    }
}
