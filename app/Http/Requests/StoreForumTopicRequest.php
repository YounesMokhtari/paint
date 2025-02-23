<?php

namespace App\Http\Requests;

use App\Models\Forum\ForumTopicFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreForumTopicRequest extends FormRequest
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
            ForumTopicFields::TITLE => 'required|string|max:255',
            ForumTopicFields::CONTENT => 'required|string|max:255',
            ForumTopicFields::CATEGORY => 'required|string|max:255',
        ];
    }
}
