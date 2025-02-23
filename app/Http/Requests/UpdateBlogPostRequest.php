<?php

namespace App\Http\Requests;

use App\Models\BlogPosts\BlogPostFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
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
            BlogPostFields::TITLE => 'sometimes|string|max:255',
            BlogPostFields::CONTENT => 'sometimes|string',
        ];
    }
}
