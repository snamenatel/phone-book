<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Propaganistas\LaravelPhone\PhoneNumber;

class PhoneResource extends JsonResource
{

    public function toArray($request)
    {
        return PhoneNumber::make($this->phone)->formatForCountry('RU');
    }
}
