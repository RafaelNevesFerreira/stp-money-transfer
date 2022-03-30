<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentificationRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "address" => "required|string|max:200",
            "country" => "required|string|max:120",
            "email" => "required|email",
            "phone_number" => "required|alpha_num",
        ];
    }
}
