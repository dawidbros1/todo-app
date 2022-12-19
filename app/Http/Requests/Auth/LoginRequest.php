<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

# php artisan make:request Auth/LoginRequest
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // set true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "Pole adres email jest wymagane",
            'email.exists' => "Podany adres email nie istnieje",
            'password.required' => 'Pole hasło jest wymagane',
        ];
    }
}
