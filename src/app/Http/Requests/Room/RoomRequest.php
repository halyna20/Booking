<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'number_of_adults' => 'required|numeric',
            'number_of_children' => 'numeric',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }
}
