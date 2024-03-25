<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'firstname' => 'required|string|max:40|min:3',
            'lastname' => 'required|string|max:40|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'email' => 'unique:users|email|required|min:5|max:50',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ]
        ];
    }

    public function attributes()
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
