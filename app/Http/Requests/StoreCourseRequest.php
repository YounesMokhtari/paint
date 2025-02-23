<?php

namespace App\Http\Requests;

use App\Models\Courses\CourseFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            CourseFields::TITLE => ['required', 'string', 'max:255'],
            CourseFields::DESC => ['required', 'string'],
            CourseFields::CATEGORY_ID => ['required', 'exists:categories,id'],
            CourseFields::LEVEL => ['required', 'string', 'in:beginner,intermediate,advanced'],
            CourseFields::POSTER => ['required', 'image', 'max:10240'], // 10MB
            CourseFields::IS_FEATURED => ['boolean'],
            CourseFields::PRICE => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            CourseFields::TITLE . '.required' => __('courses.validation.title_required'),
            CourseFields::DESC . '.required' => __('courses.validation.description_required'),
            CourseFields::CATEGORY . '.required' => __('courses.validation.category_required'),
            CourseFields::LEVEL . '.required' => __('courses.validation.level_required'),
            CourseFields::POSTER . '.required' => __('courses.validation.poster_required'),
            CourseFields::POSTER . '.image' => __('courses.validation.poster_must_be_image'),
            CourseFields::POSTER . '.max' => __('courses.validation.poster_max_size'),
        ];
    }
}
