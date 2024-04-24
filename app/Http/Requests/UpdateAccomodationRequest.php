<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccomodationRequest extends FormRequest
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
            'name' => 'nullable|string|max:40',
            'description' => 'nullable|string|max:10000',
            'type' => ['nullable', 'in:maison,appartement'],
            'price' => 'nullable|numeric|max:1000',
            'dispo' => 'nullable|int',
            'address' => 'nullable|string|max:200',
            'cp' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:20',
            'superficy' => 'nullable|numeric|max:1000',
            'rooms' => 'nullable|integer',
            'beds' => 'nullable|integer',
            'persons' => 'nullable|integer',
            'note' => 'nullable|numeric|max:5',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nom',
            'description' => 'Description',
            'type' => 'Type',
            'price' => 'Prix',
            'dispo' => 'Disponibilité',
            'address' => 'Adresse',
            'cp' => 'Code Postal',
            'city' => 'Ville',
            'country' => 'Pays',
            'superficy' => 'Superficie',
            'rooms' => 'Chambres',
            'beds' => 'Lits',
            'persons' => 'Voyageurs',
            'note' => 'Note',
        ];
    }
}
