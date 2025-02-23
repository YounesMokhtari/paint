<?php

namespace App\Http\Requests;

use App\Models\Forum\ForumReplyFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateForumReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            ForumReplyFields::CONTENT => 'sometimes|string',
        ];
    }
}
