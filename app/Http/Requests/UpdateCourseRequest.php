<?php

namespace App\Http\Requests;

use App\Models\Courses\CourseFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            CourseFields::TITLE => 'sometimes|string|max:255',
            CourseFields::CATEGORY_ID => 'sometimes|exists:categories,id',
            CourseFields::DESC => 'sometimes|string',
            CourseFields::LEVEL => 'sometimes|string|in:beginner,intermediate,advanced',
            CourseFields::IS_FEATURED => 'sometimes|boolean',
            CourseFields::POSTER => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
