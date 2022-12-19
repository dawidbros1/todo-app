<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

# php artisan make:request Task/StoreRequest
class StoreRequest extends FormRequest
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
            'name' => ['required', 'between:3,32'],
            'description' => ['required', 'between:3,255'],
            'deadline' => ['required', 'date_format:Y-m-d\TH:i', 'after:now'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "To pole jest wymagane",
            'name.between' => "Nazwa zadania musi składać się od :min do :max znaków",

            'description.required' => "To pole jest wymagane",
            'description.between' => "Opis zadania musi składać się od :min do :max znaków",

            'deadline.required' => "To pole jest wymagane",
            'deadline.date_format' => "Niewłaściwy format daty",
            'deadline.after' => "Termin musi być datą późniejszą",
        ];
    }
}

# How use StoreRequest
#
# In controller method use
# public function store(StoreRequest $request, $category)
# indtead of
# public function store(Request $request, $category)
# and next in code write
# $request->validated();
#
# More Category/StoreRequest
