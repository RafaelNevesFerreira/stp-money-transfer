<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            "card_no" => "required|numeric",
            "cvc" => "required",
            "exp_month" => "required|min:1|max:3",
            "exp_year" => "required|min:1|max:4"
        ];
    }
}
