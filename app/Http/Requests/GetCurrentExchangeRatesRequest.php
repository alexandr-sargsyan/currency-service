<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


/**
 * @property string $currency_code
 */
class GetCurrentExchangeRatesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
//            'currency_code' => ['required','string']
        ];
    }

    public function getCurrencyCode(): string
    {
        return $this->currency_code;
    }
}
