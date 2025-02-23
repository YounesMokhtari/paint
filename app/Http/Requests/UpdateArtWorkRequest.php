<?php

namespace App\Http\Requests;

use App\Models\ArtWorks\ArtWorkFields;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArtWorkRequest extends FormRequest
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
            ArtWorkFields::TITLE => 'sometimes|string|max:255',
            ArtWorkFields::DESCRIPTION => 'sometimes|string',
            ArtWorkFields::IMAGE => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
