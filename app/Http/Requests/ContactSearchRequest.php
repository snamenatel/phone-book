<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

/**
 * @property string $phone
 * @property string $author
 * @property string $name
 **/
class ContactSearchRequest extends ApiRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'phone' => 'string',
            'author' => 'string',
            'name' => 'string',
            'my' => 'boolean',
            'favorite' => 'boolean',
        ];
    }
}
