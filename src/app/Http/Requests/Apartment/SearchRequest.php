<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'city.required' => 'Введіть назву міста',
            'dateFrom.required' => 'Вкажіть дату заїзду',
            'dateTo.required' => 'Вкажіть дату виїзду'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => 'required|string',
            'adult' => 'required|numeric',
            'child' => 'nullable|numeric',
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date',
            'roomCount' => 'required|numeric'
        ];
    }
}
