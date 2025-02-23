<?php

namespace App\Http\Requests;

use App\Models\ArtWorks\ArtWorkFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreArtWorkRequest extends FormRequest
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
            ArtWorkFields::TITLE => 'required|string|max:255',
            ArtWorkFields::DESCRIPTION => 'required|string|max:255',
            ArtWorkFields::IMAGE => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ArtWorkFields::CATEGORY => 'required|string|in:painting,sculpture,digital,photography',
        ];
    }
}
