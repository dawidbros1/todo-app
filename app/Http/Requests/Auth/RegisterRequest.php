<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

# php artisan make:request Auth/RegisterRequest
class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:6', 'max:32'],
            'email' => ['required', 'min:6', 'max:32', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:32'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane',
        ];
    }
}
