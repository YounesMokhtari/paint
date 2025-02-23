<?php

namespace App\Http\Requests;

use App\Models\BlogPosts\BlogPostFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
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
            BlogPostFields::TITLE => 'required|string|max:255',
            BlogPostFields::CONTENT => 'required|string',
            BlogPostFields::CATEGORY => 'required|string|max:255',
        ];
    }
}
