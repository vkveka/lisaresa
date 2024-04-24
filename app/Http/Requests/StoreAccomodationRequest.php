<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccomodationRequest extends FormRequest
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
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:10000',
            'type' => ['required', 'in:maison,appartement'],
            'price' => 'required|numeric|max:10000',
            'dispo' => 'required|int',
            'address' => 'required|string|max:200',
            'cp' => 'required|string|max:20',
            'city' => 'required|string|max:50',
            'country' => 'required|string|max:20',
            'superficy' => 'required|numeric|max:1000',
            'rooms' => 'required|integer',
            'beds' => 'required|integer',
            'persons' => 'required|integer',
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
