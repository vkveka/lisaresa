<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstname' => 'nullable|max:40|min:3',
            'lastname' => 'nullable|max:40|min:3',
            'email' => 'nullable|email|max:50|unique:users|min:5|max:50',
            'oldPassword' => 'nullable',
            'password' => [
                'nullable', 'confirmed',
                Password::min(8) // minimum 8 caractères   
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()  // au moins une lettre
                    ->numbers() // au moins un chiffre
                    ->symbols() // au moins un caractère spécial     
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'firstname' => 'Prénom',
            'lastname' => 'Nom',
            'image' => 'Image',
            'email' => 'Email',
            'password' => 'Mot de passe',
        ];
    }
}
