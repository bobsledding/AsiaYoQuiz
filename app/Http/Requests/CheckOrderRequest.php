<?php

namespace App\Http\Requests;

use App\Rules\AcceptCurrencies;
use App\Rules\EnglishName;
use App\Rules\PriceUpperLimit;
use App\Rules\TitleCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|string',
            'name' => ['required', 'string', new EnglishName(), new TitleCase()],
            'address' => 'required|array:city,district,street',
            'address.city' => 'required|string',
            'address.district' => 'required|string',
            'address.street' => 'required|string',
            'price' => ['required', 'numeric', new PriceUpperLimit],
            'currency' => ['required', 'string', new AcceptCurrencies()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response($validator->errors()->first(), Response::HTTP_BAD_REQUEST)
        );
    }
}
