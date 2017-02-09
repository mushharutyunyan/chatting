<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoomRequest extends Request
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
            'name' => 'required|min:3|unique:rooms',
            'image' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.min' => 'Name Minimum 3 simvols!',
            'name.unique' => 'Name already exists!',
            'image.required' => 'Image Field is required!',
        ];
    }
}
