<?php

namespace App\Http\Requests;

use App\Models\Videos\VideoFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            VideoFields::COURSE_ID => 'required|exists:courses,id',
            VideoFields::TITLE => 'required|string|max:255',
            VideoFields::DESCRIPTION => 'required|string',
            VideoFields::VIDEO => 'required|file|mimetypes:video/*',
            VideoFields::DURATION => 'required|integer|min:1',
        ];
    }
}
