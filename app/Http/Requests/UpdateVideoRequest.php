<?php

namespace App\Http\Requests;

use App\Models\Videos\VideoFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            VideoFields::TITLE => 'sometimes|string|max:255',
            VideoFields::DESCRIPTION => 'sometimes|string|max:255',
            VideoFields::VIDEO => 'sometimes|url',
            VideoFields::DURATION => 'sometimes|integer',
        ];
    }
}
