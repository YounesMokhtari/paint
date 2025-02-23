<?php

namespace App\Http\Requests;

use App\Models\Support\SupportTicketFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupportTicketRequest extends FormRequest
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
            SupportTicketFields::SUBJECT => 'sometimes|string|max:255',
            SupportTicketFields::MESSAGE => 'sometimes|string|max:255',
            SupportTicketFields::STATUS => 'sometimes|string|in:open,pending,closed',
        ];
    }
}
