<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'string|nullable|min:2',
            'last_name' => 'string|nullable|min:2',
            'phone' => 'string|nullable||min:9',
            'country_id' => 'numeric|nullable'
        ];
    }
}
