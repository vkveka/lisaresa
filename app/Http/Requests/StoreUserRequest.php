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
            'firstname' => 'required|string|max:40',
            'lastname' => 'required|string|max:40',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'email' => 'unique:users|email|required',
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

    public function messages()
    {
        return [
            'firstname.required' => 'Le champ \'Prénom\' est requis.',
            'firstname.string' => 'Le champ \'Prénom\' doit être une chaîne de caractères.',
            'firstname.max' => 'Le champ \'Prénom\' ne doit pas dépasser :max caractères.',
            'lastname.required' => 'Le champ \'Nom\' est requis.',
            'lastname.string' => 'Le champ \'Nom\' doit être une chaîne de caractères.',
            'lastname.max' => 'Le champ \'Nom\' ne doit pas dépasser :max caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Le fichier doit être de type : :values.',
            'image.max' => 'La taille du fichier ne doit pas dépasser :max kilo-octets.',
            'email.required' => 'Le champ "Email" est requis.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le champ "Mot de passe" est requis.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.mixed_case' => 'Le mot de passe doit contenir des lettres majuscules et minuscules.',
            'password.letters' => 'Le mot de passe doit contenir au moins une lettre.',
            'password.numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols' => 'Le mot de passe doit contenir au moins un caractère spécial.',
        ];
    }
}
