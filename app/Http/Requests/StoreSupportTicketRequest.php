<?php

namespace App\Http\Requests;

use App\Models\Support\SupportTicketFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupportTicketRequest extends FormRequest
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
            SupportTicketFields::USER_ID => 'required|exists:users,id',
            SupportTicketFields::SUBJECT => 'required|string|max:255',
            SupportTicketFields::MESSAGE => 'required|string',
            SupportTicketFields::STATUS => 'required|string|in:open,pending,closed',
        ];
    }
}
