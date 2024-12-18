<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Zorg ervoor dat de gebruiker geautoriseerd is om deze aanvraag te doen
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'voornaam' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+$/'],
            'tussenvoegsel' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z]*$/'],
            'achternaam' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];
    }
}