<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email' => 'required|email|max:255|min:2|unique:users',
            'name' => 'required|string|max:255|min:2',
            'date_of_joining' => 'required|date',
            'date_of_leaving' => 'nullable|date|after:date_of_joining',
            'avatar' => 'required|image|max:10240'
        ];
    }
}
