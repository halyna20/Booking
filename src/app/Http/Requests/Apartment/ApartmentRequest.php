<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|filled|min:3',
            'address' => 'required|string|filled|min:5',
            'description' => 'string',
            'city_id' => 'required|numeric|exists:App\Models\City,id',
            'type_id' => 'required|numeric|exists:App\Models\Type,id'
        ];
    }
}
