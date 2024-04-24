<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'date_in' => 'nullable|date|after_or_equal:today',
            'date_out' => 'nullable|date|after:date_in',
            'numero' => 'nullable|string|max:15|min:10',
            'price' => 'nullable|numeric|max:9999.99',
        ];
    }

    public function attributes(): array
    {
        return [
            'date_in' => 'Date d\'arrivée',
            'date_out' => 'Date de départ',
            'numero' => 'Numéro de réservation',
            'price' => 'Coût de la réservation',
        ];
    }
}
