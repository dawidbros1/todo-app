<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

# php artisan make:request Category/StoreRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "To pole jest wymagane",
            'name.between' => "Nazwa kategorii musi składać się od :min do :max znaków",
        ];
    }
}

# How use StoreRequest
#
# In controller method use
# public function store(Request $request, $category)
# ...
# $store = new StoreRequest();
# $validator = Validator::make($request->all(), $store->rules(), $store->messages());
#
#  if ($validator->fails()) {
#       code when validation is failed
#  }
#
