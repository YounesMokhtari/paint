<?php

namespace App\Http\Requests;

use App\Models\Forum\ForumReplyFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreForumReplyRequest extends FormRequest
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
            ForumReplyFields::TOPIC_ID => 'required|exists:forum_topics,id',
            // ForumReplyFields::USER_ID => 'required|exists:users,id',
            ForumReplyFields::CONTENT => 'required|string',
        ];
    }
}
