<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindRentTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'minPrice' => 'nullable|numeric',
            'maxPrice' => 'nullable|numeric',
        ];
    }
}
