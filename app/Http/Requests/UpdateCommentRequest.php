<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
            'title' => 'nullable|string|max:40|min:3',
            'content' => 'nullable|string|max:1000|min:3',
            'note' => 'nullable|integer|max:5|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'title' => '\'Titre\'',
            'content' => '\'Votre commentaire\'',
            'note' => '\'Note\'',
        ];
    }
}
