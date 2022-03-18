<?php

namespace App\Http\Requests;

class UserCreateRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:users,email',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|max:255',
        ];
    }

}
