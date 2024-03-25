<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'date_in' => 'required|date|after_or_equal:today',
            'date_out' => 'required|date|after:date_in',
            'numero' => 'required|string|max:15|min:10',
            'price' => 'required|numeric|max:9999.99',
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
