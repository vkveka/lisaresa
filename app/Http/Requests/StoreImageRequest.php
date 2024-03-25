<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'name' => 'required|array',
            'name.*' => 'image|mimes:jpg,jpeg,png,svg,webp|max:10000',
            'accomodation_id' => 'integer',
            'index' => 'integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '\'Nom\'',
        ];
    }
}
